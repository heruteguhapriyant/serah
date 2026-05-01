<?php
class ProgramController extends Controller {
    public function index(): void {
        $model    = new ProgramModel();
        $programs = $model->getActive();
        $this->view('public/program/index', ['programs' => $programs]);
    }

    public function detail(string $id): void {
        $model   = new ProgramModel();
        $program = $model->find((int)$id);
        if (!$program) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        $this->view('public/program/detail', ['program' => $program]);
    }
}