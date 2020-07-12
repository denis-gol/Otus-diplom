<?php


namespace App\Http\Controllers\API;


use App\Entity\Task;
use App\Http\Controllers\Controller;
use App\Jobs\StudentTaskJob;
use App\Model\StudentTaskFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InteractionController extends Controller
{

    /** @var StudentTaskFactory */
    protected $studentTaskFactory;

    /**
     * InteractionController constructor.
     * @param StudentTaskFactory $studentTaskFactory
     */
    public function __construct(StudentTaskFactory $studentTaskFactory)
    {
        $this->studentTaskFactory = $studentTaskFactory;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendTask(Request $request)
    {
        $requestedModel = json_decode($request->getContent(), true);
        if (json_last_error() === 0) {

            // проверка, что не превышен максимальный балл за задание
            $task = Task::query()->where('id', $requestedModel['task_id'])
                ->get(['max_point'])->toArray();
            if ($requestedModel['point'] > $task[0]['max_point']) {
                return response()->json([
                    'message' => 'Maximum points exceeded',
                    'maximum' => $task[0]['max_point'],
                ], 400);
            }

            /** todo
             * 1) нужна проверка полноты заполнения модели
             * 4) приём инфы по заданиям пачкой, а не по 1
             */
            $studentTask = $this->studentTaskFactory->make($requestedModel);
            StudentTaskJob::dispatch($studentTask);
            return response()->json(['message' => 'queued']);
        }else {
            return response()->json([
                'message' => 'Invalid post data',
            ], 400);
        }
    }
}
