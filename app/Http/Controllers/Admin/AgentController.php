<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function agentProfileIndex()
    {
        return view('admin.pages.agents.agent-profile');
    }

    public function addAgentIndex()
    {
        return view('admin.pages.agents.add-agent');
    }
    
    public function addAgentWizardIndex()
    {
        return view('admin.pages.agents.add-agent-wizard');
    }

    public function editAgentIndex()
    {
        return view('admin.pages.agents.edit-agent');
    }

    public function allAgentsIndex()
    {
        return view('admin.pages.agents.all-agents');
    }

    public function agentInvoiceIndex()
    {
        return view('admin.pages.agents.agent-invoice');
    }
}
