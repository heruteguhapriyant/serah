<?php
// app/controllers/AdminHomeController.php

class AdminHomeController extends Controller {
    public function index(): void {
        $this->requireAdmin();

        $programModel = new ProgramModel();
        $rekapModel   = new RekapModel();

        $stats = [
            'programs' => count($programModel->getActive()),
            'rekaps'   => count($rekapModel->getAll()),
        ];

        $this->view('admin/dashboard', ['stats' => $stats]);
    }
}
