<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\TugasHarian;

class NotificationService
{
    /**
     * Send notification to users based on division
     */
    public static function sendToDivision(string $division, string $title, string $message, string $type = 'info', ?TugasHarian $tugasHarian = null)
    {
        $users = User::where('divisi', $division)->get();
        
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'tugas_harian_id' => $tugasHarian?->id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
            ]);
        }
    }
    
    /**
     * Send notification to specific users
     */
    public static function sendToUsers(array $userIds, string $title, string $message, string $type = 'info', ?TugasHarian $tugasHarian = null)
    {
        foreach ($userIds as $userId) {
            Notification::create([
                'user_id' => $userId,
                'tugas_harian_id' => $tugasHarian?->id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
            ]);
        }
    }
    
    /**
     * Send notification when a file is uploaded
     */
    public static function fileUploaded(TugasHarian $tugasHarian, int $tahapanId)
    {
        $tahapanData = [
            1 => ['nextDivision' => 'Finance', 'nextTahapan' => 2, 'tahapanName' => 'Pengumpulan Data'],
            2 => ['nextDivision' => 'Admin', 'nextTahapan' => 3, 'tahapanName' => 'Pembuatan Invoice DP'],
            3 => ['nextDivision' => 'Admin', 'nextTahapan' => 4, 'tahapanName' => 'Penjadwalan Inspeksi'],
            4 => ['nextDivision' => 'Surveyor', 'nextTahapan' => 5, 'tahapanName' => 'Inspeksi'],
            5 => ['nextDivision' => 'Surveyor', 'nextTahapan' => 6, 'tahapanName' => 'Proses Analisa'],
            6 => ['nextDivision' => 'Surveyor', 'nextTahapan' => 7, 'tahapanName' => 'Review Nilai'],
            7 => ['nextDivision' => 'EDP', 'nextTahapan' => 8, 'tahapanName' => 'Kirim Draft Resume'],
            8 => ['nextDivision' => 'EDP', 'nextTahapan' => 9, 'tahapanName' => 'Draft Laporan'],
            9 => ['nextDivision' => 'EDP', 'nextTahapan' => 10, 'tahapanName' => 'Review/Final'],
            10 => ['nextDivision' => 'EDP', 'nextTahapan' => 11, 'tahapanName' => 'Nomor Laporan'],
            11 => ['nextDivision' => 'Admin', 'nextTahapan' => 12, 'tahapanName' => 'Laporan Rangkap 3'],
            12 => ['nextDivision' => null, 'nextTahapan' => null, 'tahapanName' => 'Pengiriman Dokumen'],
        ];
        
        if (isset($tahapanData[$tahapanId])) {
            $data = $tahapanData[$tahapanId];
            
            // Send completion notification to current division
            $currentDivision = $tahapanId <= 4 || $tahapanId == 12 ? 'Admin' : 
                              ($tahapanId <= 7 ? 'Surveyor' : 
                              ($tahapanId <= 11 ? 'EDP' : 'Finance'));
            
            self::sendToDivision(
                $currentDivision,
                'Tahapan Selesai',
                "File untuk tahapan {$data['tahapanName']} (No. PPJP: {$tugasHarian->no_ppjp}) telah berhasil diupload.",
                'success',
                $tugasHarian
            );
            
            // Send next task notification if there is a next step
            if ($data['nextDivision']) {
                $nextTahapanData = $tahapanData[$data['nextTahapan']];
                self::sendToDivision(
                    $data['nextDivision'],
                    'Tahapan Baru Tersedia',
                    "Tahapan {$nextTahapanData['tahapanName']} untuk No. PPJP: {$tugasHarian->no_ppjp} sudah tersedia. Silakan segera upload file yang diperlukan.",
                    'info',
                    $tugasHarian
                );
            } else {
                // Send completion notification to all divisions
                self::sendToDivision(
                    'Admin',
                    'Tugas Selesai',
                    "Semua tahapan untuk tugas dengan No. PPJP: {$tugasHarian->no_ppjp} telah selesai.",
                    'success',
                    $tugasHarian
                );
                
                self::sendToDivision(
                    'Surveyor',
                    'Tugas Selesai',
                    "Semua tahapan untuk tugas dengan No. PPJP: {$tugasHarian->no_ppjp} telah selesai.",
                    'success',
                    $tugasHarian
                );
                
                self::sendToDivision(
                    'EDP',
                    'Tugas Selesai',
                    "Semua tahapan untuk tugas dengan No. PPJP: {$tugasHarian->no_ppjp} telah selesai.",
                    'success',
                    $tugasHarian
                );
                
                self::sendToDivision(
                    'Finance',
                    'Tugas Selesai',
                    "Semua tahapan untuk tugas dengan No. PPJP: {$tugasHarian->no_ppjp} telah selesai.",
                    'success',
                    $tugasHarian
                );
            }
        }
    }
}