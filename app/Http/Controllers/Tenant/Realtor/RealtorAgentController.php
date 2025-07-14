<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtorAgentController extends Controller
{
    public function agentProfileIndex()
    {
        return view('realtor.pages.agents.agent-profile');
    }

    public function addAgentIndex()
    {
        return view('realtor.pages.agents.add-agent');
    }

    public function addAgentWizardIndex()
    {
        return view('realtor.pages.agents.add-agent-wizard');
    }

    public function editAgentIndex()
    {
        return view('realtor.pages.agents.edit-agent');
    }

    public function allAgentsIndex()
    {
        return view('realtor.pages.agents.all-agents');
    }

    public function agentInvoiceIndex()
    {
        return view('realtor.pages.agents.agent-invoice');
    }
}
