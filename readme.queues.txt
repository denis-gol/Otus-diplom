

КОНСПЕКТ ПО ВИДЕОЛЕКЦИИ АФАНАСЬЕВА Д.
Основы работы с очередями (Queue, Jobs)


принцип парето

очередь - пул задач ФИФО, но не совсем
задача job - элемент очереди
воркер worker - приложение, слушает очередь и выполняет задачи


создать файл миграции
php artisan queue:table // для задач
php artisan queue:failed-table // для зафейленых задач

накатить миграции:
php artisan migrate

создаем задачи:
php artisan make:job BlogPostAfterCreateJob // задача после создания поста
php artisan make:job BlogPostAfterDeleteJob // задача после удаления поста
php artisan make:job ProcessVideoJob        // задача для обработки видео


interface ShouldQueue - пустой, показывает, что задача планировалась ставиться в очередь,
    а не выполняться сразу

trait Dispatchable - позволяет данному классу запускаться, самозапуск, в очередь или сразу
trait InteractsWithQueue - управление объектом очереди (кол-во попыток, удалить из очереди итд)
trait Queueable - логика работы задачи (коннект, имя очереди, задержка до выполнения итд)
trait SerializesModels - очередь не будет сериализовать всю модель, а только что укажем

Одна из причин падения очередей - хранение в них объектов. Надо хранить id, имена, а объекты порождать.

в Задаче не храним логику, только тонкий обработчик в handle

прописываем в классах Задачу:
    private $studentId;
    public function __construct($studentId)
    public function handle()


смотрим настройки очереди
    /config/queue.php
    'default' => env('QUEUE_CONNECTION', 'sync') - задачи выполнять немедленно
меняем в .env
    QUEUE_CONNECTION=database - работаем с БД

    'connections' => [
        'sync' => [
            'driver' => 'sync', // драйвер для мгновенного выполнения очереди
        ],
        'database' => [
            'driver' => 'database', // очередь работает с БД
            'table' => 'jobs', // название таблицы, можно взять другую, свою
            'queue' => 'default', // название очереди, мб несколько
            // если задача выполнялась дольше без удаления, то она вновь вернется в очередь
            // в сек, надо убивать задачу раньше этого времени или она вернется и может задублиться
            'retry_after' => 90,
        ],

    'failed' => [...] // куда падают зафейленые задачи


Запуск Задачи в Контроллере:
    $job = new StudentAfterCreateJob($student_id);
    $this->dispatch($job);

    при этом - если у $job в классе есть implements ShouldQueue, оно поставится в очередь,
    если нет, то выполнится сразу


Добавление в определенную очередь:
    public function __construct(Student $student)
        {
            $this->student = $student;
            $this->onQueue('asdfasdf'); // название очереди
        }


Объект очереди (то, что в БД легло в job):
{
  "uuid": "fbb826b4-a1ae-4f24-8bf8-ebc1c8857429",       //
  "displayName": "App\\Jobs\\StudentAfterCreateJob",    //
  "job": "Illuminate\\Queue\\CallQueuedHandler@call",   //
  "maxTries": null,                                     // кол-во попыток (1 или 3 дефолтно)
  "maxExceptions": null,                                //
  "delay": null,                                        // отсрочка чего-то там
  "timeout": null,                                      // разрешенное время выполнения
  "timeoutAt": null,                                    // дата, до которой можно делать попытки
  "data": {                                             //
    "commandName": "App\\Jobs\\StudentAfterCreateJob",  // имя джоба
    "command": <сериализованные данные>                 // данные (id модели, коннекты итд)
  }
}


команды запуска консьюмера (как демон):
> php artisan queue:work
    запускает процесс обработки как демон
    все изменения в коде после запуска приняты не будут
    т.е. после апдейта потребуется перезапуск команды

> php artisan queue:work --queue=queueName1,queueName2
    выполнить сначала все задачи из очереди 1, потом очереди 2

> php artisan queue:listen
    запускает процесс обработки очереди
    изменения сделанные в коде будут приняты
    хуже по производительности в сравнении с work:queue
    ДЛЯ РАЗРАБОТКИ

НА СЕРВЕРЕ:
запуск супервизора и настройка тут:
https://laravel.com/docs/7.x/queues#supervisor-configuration


еще команды (не все):
> php artisan queue:restart
    мягкий перезапуск демона queue:work после того, как тот завершит выполняемую задачу

> php artisan queue:failed
    просмотр таблицы фейленых задач

> php artisan queue:retry all
    возврат в очередь всех фейленых задач

> php artisan queue:retry 5
    возврат фейленой задачи №5 в очередь


Вызов (варианты запуска):
    StudentAfterDeleteJob::dispatch($id); // достаточно только передать $id

    StudentAfterDeleteJob::dispatchNow($id); // выполнится моментально, без очереди

    dispatch(new StudentAfterDeleteJob($id)); // хелперы
    dispatch_now(new StudentAfterDeleteJob($id));

    $this->dispatch(new StudentAfterDeleteJob($id)); // если у класса (родителя) есть трейт DispatchesJobs
    $this->dispatchNow(new StudentAfterDeleteJob($id));


Опции:
    StudentAfterDeleteJob::dispatch($id)->onQueue(<указать название очереди>);
    StudentAfterDeleteJob::dispatch($id)->delay(<указать задержку, сек>);



