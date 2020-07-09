<?php


namespace App\Http\Controllers\API;


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

            /** todo нужны проверки
             * 1) полноты заполнения модели
             * 2) Уже существования связки студент-задача. Тут вопрос что нужно делать игнорить, выдавать ошибку или затирать предыдущий результат. Скорее последнее.
             */
            $studentTask = $this->studentTaskFactory->make($requestedModel);
            StudentTaskJob::dispatch($studentTask);
            return response()->json([]);
        }else {
            return response()->json([
                'message' => 'Invalid post data',
            ], 400);
        }
    }
}
