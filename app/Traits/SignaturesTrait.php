<?php

namespace ActivismeBE\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Trait SignaturesTrait
 *
 * @package ActivismeBE\Traits
 */
trait SignaturesTrait
{
    /**
     * Export all the signatyures for a petition.
     *
     * @param  string   $type           The export type for the file. 'xls' or 'pdf'
     * @param  int      $petitionId     The petition id in the database.
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function downloadSignature(string $type, int $petitionId)
    {
        try {
            $timestamp = time();

            // Geen authorizatie nodig omdat er word gekeken op de id van de aangemelde gebruiker.
            $signatures = $this->petition->where('id', $petitionId)->where('author_id', auth()->user()->id)
                ->with(['signatures.country'])->firstOrFail();

            if ((int) count($signatures) > 0) { // De petitie heeft meer dan 0 handtekeningen
                Excel::create("{$timestamp}-Handtekeningen", function ($excel) use ($signatures) {
                    $excel->sheet('Handtekeningen', function ($sheet) use ($signatures) {
                        // TODO: het opbouwen van de view. Omdat deze momenteel nog leeg is.
                        $sheet->loadView('signatures.export', compact('signatures'));
                    });
                })->export($type); // Can only be 'xls' or 'pdf'
            } else { // De petitie heeft geen handtekeningen.
                flash('Kan de handtekeningen niet exporteren. Omdat de petitie geen handtekeningen heeft.')->warning();
                return back(302);
            }
        } catch (ModelNotFoundException $exception) {
            return app()->abort(404);
        }
    }
}
