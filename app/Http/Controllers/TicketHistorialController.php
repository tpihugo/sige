<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\VsTicket;
use Carbon\Carbon;

class TicketHistorialController extends Controller
{
    public function index()
    {

        $data = Ticket::select('id', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->locale('es')->format('M');
        });
        $months = [];
        $monthCount = [];
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        $tecnicals = VsTicket::select('id', 'tecnico')->get()->groupBy(function ($tecnicals) {
            return $tecnicals->tecnico;
        });
        $countTickets = [];
        $tecnical = [];
        foreach ($tecnicals as $solicitante => $id) {
            $tecnical[] = $solicitante;
            $countTickets[] = count($id);
        }
        $ticketsIssue = VsTicket::select('id', 'problema')->get()->groupBy(function ($ticketsIssue) {
            return $ticketsIssue->problema;
        });

        $idTickets = [];
        $issues = [];

        foreach ($ticketsIssue as $issue => $item) {
            $issues[] = $issue;
            $idTickets[] = count($item);
        }

        $ticketsCategory = VsTicket::select('id', 'categoria')->get()->groupBy(function ($ticketsCategory) {
            return $ticketsCategory->categoria;
        });
        $ticketsC = [];
        $categories = [];
        foreach ($ticketsCategory as $Category => $item) {
            $categories[] = $Category;
            $ticketsC[] = count($item);
        }

        return view(
            'ticket.historial',
            [
                'months' => $months,
                'monthCount' => $monthCount,
                'tecnical' => $tecnical,
                'countTickets' => $countTickets,
                'idTickets' => $idTickets,
                'issues' => $issues,
                'categories' => $categories,
                'ticketsC' => $ticketsC,
            ]
        );
    }
}
