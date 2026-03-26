<?php
// app/controllers/ProgramController.php

class ProgramController extends Controller {
    public function index(): void {
        $model    = new ProgramModel();
        $programs = $model->getActive();
        $this->view('public/program/index', ['programs' => $programs]);
    }
}
