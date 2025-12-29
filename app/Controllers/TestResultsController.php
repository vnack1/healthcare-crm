<?php

namespace App\Controllers;

use App\Models\TestResultsModel;
use App\Models\InspectionListModel;
use CodeIgniter\Controller;

class TestResultsController extends Controller
{
    protected $testResultsModel;
    protected $inspectionListModel;

    public function __construct()
    {
        $this->testResultsModel = new TestResultsModel();
        $this->inspectionListModel = new InspectionListModel();
    }

    // 특정 ICU의 검사 결과 보기
    public function viewResults($icuIdx)
    {
        $results = $this->testResultsModel->getResultsByIcu($icuIdx);
        return view('test_results/view_results', ['results' => $results]);
    }

    // 검사 결과 입력 페이지 표시
    public function createResult($icuIdx)
    {
        $inspections = $this->inspectionListModel->findAll(); // 모든 검사항목 가져오기
        return view('test_results/create_result', ['icuIdx' => $icuIdx, 'inspections' => $inspections]);
    }

    // 검사 결과 저장
    public function saveResult()
    {
        $data = $this->request->getPost();

        $saveData = [
            'icu_idx' => $data['icu_idx'],
            'inspect_idx' => $data['inspect_idx'],
            'assessment' => $data['assessment'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $this->testResultsModel->saveTestResult($saveData);

        return redirect()->to('/icu/view/' . $data['icu_idx'])->with('message', 'Test result saved successfully.');
    }

    // 검사 결과 업데이트 페이지(수정 페이지)
    public function editResult($testIdx)
    {
        $result = $this->testResultsModel->find($testIdx);
        $inspections = $this->inspectionListModel->findAll(); // 모든 검사항목 가져오기

        if (!$result) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Test result not found');
        }

        return view('test_results/edit_result', ['result' => $result, 'inspections' => $inspections]);
    }

    // 검사 결과 업데이트
    public function updateResult($testIdx)
    {
        $data = $this->request->getPost();

        $updateData = [
            'test_idx' => $testIdx,
            'assessment' => $data['assessment'],
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $this->testResultsModel->update($testIdx, $updateData);

        return redirect()->to('/icu/view/' . $data['icu_idx'])->with('message', 'Test result updated successfully.');
    }
}