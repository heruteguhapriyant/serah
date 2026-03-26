<?php
// app/controllers/HomeController.php

class HomeController extends Controller {
    public function index(): void {
        $programModel = new ProgramModel();
        $rekapModel   = new RekapModel();

        $programs = array_slice($programModel->getActive(), 0, 3);
        $rekaps   = array_slice($rekapModel->getAll(), 0, 3);

        $this->view('public/home/index', [
            'programs' => $programs,
            'rekaps'   => $rekaps,
        ]);
    }
}
