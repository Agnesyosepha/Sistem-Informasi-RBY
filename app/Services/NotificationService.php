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
        // Data untuk setiap tahapan (diperbarui menjadi 15 tahapan)
        $tahapanData = [
            1 => ['division' => 'Admin', 'nextDivision' => 'Finance', 'nextTahapan' => 2, 'tahapanName' => 'Pengumpulan Data'],
            2 => ['division' => 'Finance', 'nextDivision' => 'Admin', 'nextTahapan' => 3, 'tahapanName' => 'Pembuatan Invoice DP'],
            3 => ['division' => 'Admin', 'nextDivision' => 'Admin', 'nextTahapan' => 4, 'tahapanName' => 'Penjadwalan Inspeksi'],
            4 => ['division' => 'Admin', 'nextDivision' => 'Surveyor', 'nextTahapan' => 5, 'tahapanName' => 'Inspeksi'],
            5 => ['division' => 'Surveyor', 'nextDivision' => 'Surveyor', 'nextTahapan' => 6, 'tahapanName' => 'Proses Analisa'],
            6 => ['division' => 'Surveyor', 'nextDivision' => 'Surveyor', 'nextTahapan' => 7, 'tahapanName' => 'Review Nilai'],
            7 => ['division' => 'Surveyor', 'nextDivision' => 'EDP', 'nextTahapan' => 8, 'tahapanName' => 'Kirim Draft Resume'],
            8 => ['division' => 'EDP', 'nextDivision' => 'Admin', 'nextTahapan' => 9, 'tahapanName' => 'Draft Laporan'],
            9 => ['division' => 'Admin', 'nextDivision' => 'Reviewer', 'nextTahapan' => 10, 'tahapanName' => 'Final'],
            10 => ['division' => 'Reviewer', 'nextDivision' => 'Reviewer', 'nextTahapan' => 11, 'tahapanName' => 'Review'],
            11 => ['division' => 'Reviewer', 'nextDivision' => 'Finance', 'nextTahapan' => 12, 'tahapanName' => 'Review Approval'],
            12 => ['division' => 'Finance', 'nextDivision' => 'EDP', 'nextTahapan' => 13, 'tahapanName' => 'Invoice Pelunasan'],
            13 => ['division' => 'EDP', 'nextDivision' => 'EDP', 'nextTahapan' => 14, 'tahapanName' => 'Nomor Laporan'],
            14 => ['division' => 'EDP', 'nextDivision' => 'EDP', 'nextTahapan' => 15, 'tahapanName' => 'Laporan Lengkap'],
            15 => ['division' => 'EDP', 'nextDivision' => null, 'nextTahapan' => null, 'tahapanName' => 'Rangkap 3 LPA dan Pengiriman Dokumen'],
        ];
        
        if (isset($tahapanData[$tahapanId])) {
            $data = $tahapanData[$tahapanId];
            
            // Send completion notification to current division
            self::sendToDivision(
                $data['division'],
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
                
                self::sendToDivision(
                    'Reviewer',
                    'Tugas Selesai',
                    "Semua tahapan untuk tugas dengan No. PPJP: {$tugasHarian->no_ppjp} telah selesai.",
                    'success',
                    $tugasHarian
                );
            }
        }
    }
}