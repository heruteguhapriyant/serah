<?php
// app/controllers/RekapController.php

class RekapController extends Controller {
    public function index(): void {
        $model  = new RekapModel();
        $rekaps = $model->getAll();
        $this->view('public/rekap/index', ['rekaps' => $rekaps]);
    }
}
