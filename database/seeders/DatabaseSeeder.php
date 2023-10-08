<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Initiator;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\TicketMeta;
use App\Models\Helpdesk\TicketStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->seedHelpdesk();
    }

    public function seedUsers()
    {
        // Users 1-10 are agents, users 11-20 are customers
        \App\Models\User::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    /**
     * @return void
     */
    public function seedHelpdesk()
    {
        $this->seedDepartment();
        $this->seedTicket();
    }

    /**
     * @return void
     */
    public function seedDepartment()
    {
        // Create Parent Departments
        Department::factory(5)->create();
        // Create Child Departments
        $parentDeps = Department::all();
        foreach ($parentDeps as $parentDep) {
            Department::factory(1)->create([
                Department::FIELD_PARENT_ID => $parentDep->getAttribute(Department::FIELD_ID)
            ]);
        }
        // Attach 1 user to each Department based on same id
        foreach (Department::all() as $department) {
            $userId = $department->getAttribute(Department::FIELD_ID);
            $department->agents()->attach($userId);
        }
    }

    public function seedTicket()
    {
        // Create 1 parent ticket for each department
        foreach (Department::all() as $department) {
            Ticket::factory(1)->create([
                Ticket::FIELD_DEPARTMENT_ID => $department->getAttribute(Department::FIELD_ID),
                Ticket::FIELD_INITIATOR     => Initiator::Customer,
                Ticket::FIELD_CUSTOMER_ID   => $department->getAttribute(Department::FIELD_ID) + 10,
                Ticket::FIELD_AGENT_ID      => $department->agents()->first()->getAttribute(User::FIELD_ID)
            ]);
        }

        // Create agent answers for every parent ticket
        foreach (Ticket::all() as $parentTicket) {
            Ticket::factory(1)->create([
                Ticket::FIELD_PARENT_ID     => $parentTicket->getAttribute(Ticket::FIELD_ID),
                Ticket::FIELD_DEPARTMENT_ID => $parentTicket->getAttribute(Ticket::FIELD_DEPARTMENT_ID),
                Ticket::FIELD_INITIATOR     => Initiator::Agent,
                Ticket::FIELD_CUSTOMER_ID   => $parentTicket->getAttribute(Ticket::FIELD_CUSTOMER_ID),
                Ticket::FIELD_AGENT_ID      => $parentTicket->getAttribute(Ticket::FIELD_AGENT_ID),
                Ticket::FIELD_EXT_ID        => $parentTicket->getAttribute(Ticket::FIELD_EXT_ID),
                Ticket::FIELD_STATUS        => TicketStatus::Pending
            ]);
        }

        // Create customer answers for every parent ticket
        foreach (Ticket::all() as $parentTicket) {
            if ($parentTicket->isParent()) {
                Ticket::factory(1)->create([
                    Ticket::FIELD_PARENT_ID => $parentTicket->getAttribute(Ticket::FIELD_ID),
                    Ticket::FIELD_DEPARTMENT_ID => $parentTicket->getAttribute(Ticket::FIELD_DEPARTMENT_ID),
                    Ticket::FIELD_INITIATOR => Initiator::Customer,
                    Ticket::FIELD_CUSTOMER_ID => $parentTicket->getAttribute(Ticket::FIELD_CUSTOMER_ID),
                    Ticket::FIELD_AGENT_ID => $parentTicket->getAttribute(Ticket::FIELD_AGENT_ID),
                    Ticket::FIELD_EXT_ID => $parentTicket->getAttribute(Ticket::FIELD_EXT_ID),
                    Ticket::FIELD_STATUS => TicketStatus::Pending
                ]);
            }
        }

        // Create 1 meta for each Ticket
        foreach (Ticket::all() as $ticket) {
            TicketMeta::factory(1)->create([
                TicketMeta::FIELD_TICKET_ID => $ticket->getAttribute(Ticket::FIELD_ID)
            ]);
        }

    }
}
