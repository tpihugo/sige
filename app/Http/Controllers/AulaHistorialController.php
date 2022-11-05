<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\VsAreaTicket;
use App\Models\VsTicket;

class AulaHistorialController extends Controller
{
    public function index(){
        $ticketPlaces = VsTicket::select('id','tipo_espacio')->get()->groupBy(function ($ticketPlaces){
            return $ticketPlaces->tipo_espacio;
        });
        $places = [];
        $itemPlace = [];
        foreach ($ticketPlaces as $placesA => $item){
            $places[] = $placesA;
            $itemPlace[] = count($item);
        }

        $issuePlaces = VsTicket::select('tipo_espacio', 'problema')->where('tipo_espacio','Administrativa')->get()->groupBy(function ($issuePlaces){
            return $issuePlaces->problema;
        });

        $issueByPlaces = [];
        $placesIssues = [];

        foreach ($issuePlaces as $issues => $itemIssue){
            $placesIssues[] = $issues;
            $issueByPlaces[] = count($itemIssue);
        }
        $room ='Aula';
        $issuePlaceAula = VsTicket::select('tipo_espacio', 'problema')->where('tipo_espacio',$room)->get()->groupBy(function ($issuePlaces){
            return $issuePlaces->problema;
        });

        $issueByAulas = [];
        $aulaIssues = [];

        foreach ($issuePlaceAula as $issuesA => $itemIssue){
            $issueByAulas[] = $issuesA;
            $aulaIssues[] = count($itemIssue);
        }

        $issuePlaceLab = VsTicket::select('tipo_espacio', 'problema')->where('tipo_espacio','Laboratorio')->get()->groupBy(function ($issuePlaces){
            return $issuePlaces->problema;
        });

        $issueByLab = [];
        $labIssues = [];

        foreach ($issuePlaceLab as $issuesL => $itemIssue){
            $issueByLab[] = $issuesL;
            $labIssues[] = count($itemIssue);
        }

        $issuePlaceArea = VsTicket::select('id', 'estatus')->get()->groupBy(function ($issuePlaces){
            return $issuePlaces->estatus;
        });

        $ticketAreas = [];
        $ticketID = [];

        foreach ($issuePlaceArea as $issuesAR => $itemIssue){
            $ticketAreas[] = $issuesAR;
            $ticketID[] = count($itemIssue);
        }

        return view('areas.historial',
            [
                'places' => $places,
                'itemPlace' => $itemPlace,
                'placesIssues'=> $placesIssues,
                'issueByPlaces' => $issueByPlaces,
                'issueByAulas'=> $issueByAulas,
                'aulaIssues'=> $aulaIssues,
                'issueByLab' => $issueByLab,
                'labIssues' => $labIssues,
                'ticketAreas' => $ticketAreas,
                'ticketID' => $ticketID,
            ]
        );
    }
}
