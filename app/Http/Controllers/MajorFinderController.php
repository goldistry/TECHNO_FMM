<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorFinderController extends Controller
{
    public function index()
    {
        $categories = [
            'bakat_minat' => [
                'label' => 'Bakat & Minat',
                'questions' => [
                    'Hobi / aktivitas apa yang bikin kamu semangat melakukannya setiap hari?',
                    'Pelajaran sekolah apa yang paling kamu tunggu-tunggu di sekolah?',
                    'Pertanyaan 2 Bakat & Minat',
                    'Pertanyaan 3 Bakat & Minat',
                    'Pertanyaan 4 Bakat & Minat',
                    'Pertanyaan 5 Bakat & Minat',
                    'Pertanyaan 6 Bakat & Minat',
                    'Pertanyaan 7 Bakat & Minat',
                    'Pertanyaan 8 Bakat & Minat',

                ],
                'summary' => '', //summary diisi pake JavaScript based on input
            ],
            'keinginan_ortu' => [
                'label' => 'Keinginan Orang Tua',
                'questions' => [
                    'Orang tua ingin kamu bekerja di bidang apa?',
                    'Aspek apa dari jurusan yang orang tuamu harapkan bisa ditemukan di jurusan pilihan?',
                    'Pertanyaan 3 Keinginan Orang Tua',
                    'Pertanyaan 4 Keinginan Orang Tua',

                ],
                'summary' => '', 
            ],
            'financial' => [
                'label' => 'FINANCIAL',
                'questions' => [
                    'Pertanyaan 1 Financial',
                    'Pertanyaan 2 Financial',
                    'Pertanyaan 3 Financial',
                    'Pertanyaan 4 Financial',
                    'Pertanyaan 5 Financial',
                    'Pertanyaan 6 Financial',
                    'Pertanyaan 7 Financial',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Aspek Financial.',
            ],
            'prospek_karir' => [
                'label' => 'PROSPEK KARIR',
                'questions' => [
                    'Pertanyaan 1 Prospek Karir',
                    'Pertanyaan 2 Prospek Karir',
                    'Pertanyaan 2 Financial',
                    'Pertanyaan 3 Financial',
                    'Pertanyaan 4 Financial',
                    'Pertanyaan 5 Financial',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Prospek Karir.',
            ],
            'nilai_prinsip' => [
                'label' => 'Nilai dan Prinsip Hidup',
                'questions' => [
                    'Pertanyaan 1 Nilai & Prinsip',
                    'Pertanyaan 2 Nilai & Prinsip',
                    'Pertanyaan 3 Nilai & Prinsip',
                    'Pertanyaan 4 Nilai & Prinsip',
                    'Pertanyaan 5 Nilai & Prinsip',
                    'Pertanyaan 6 Nilai & Prinsip',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Nilai dan Prinsip Hidup.',
            ],
            'gaya_belajar' => [
                'label' => 'Gaya Belajar',
                'questions' => [
                    'Pertanyaan 1 Gaya Belajar',
                    'Pertanyaan 2 Gaya Belajar',
                    'Pertanyaan 3 Gaya Belajar',
                    'Pertanyaan 4 Gaya Belajar',
                    'Pertanyaan 5 Gaya Belajar',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Gaya Belajar.',
            ],
            'tipe_kecerdasan' => [
                'label' => 'Tipe Kecerdasan',
                'questions' => [
                    'Pertanyaan 1 Tipe Kecerdasan',
                    'Pertanyaan 2 Tipe Kecerdasan',
                    'Pertanyaan 3 Tipe Kecerdasan',
                    'Pertanyaan 4 Tipe Kecerdasan',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Tipe Kecerdasan.',
            ],
            'kepribadian' => [
                'label' => 'Kepribadian',
                'questions' => [
                    'Pertanyaan 1 Kepribadian',
                    'Pertanyaan 2 Kepribadian',
                    'Pertanyaan 3 Kepribadian',
                    'Pertanyaan 4 Kepribadian',
                ],
                'summary' => 'Summary Jurusan Berdasarkan Kepribadian.',
            ],
        ];

        $overallSummary = 'Summary keseluruhan akan muncul di sini setelah Anda berinteraksi dengan kategori.';
        $bakatMinatMatch = 85; // ex. of persentase berdasarkan analisis
        $keinginanOrtuMatch = 70; // ex. of persentase berdasarkan analisis
        $kompromiJurusan = 'Desain Grafis dengan fokus Multimedia atau Animasi';

        return view('chatbot', compact('categories', 'overallSummary', 'bakatMinatMatch', 'keinginanOrtuMatch', 'kompromiJurusan'));
    }
}