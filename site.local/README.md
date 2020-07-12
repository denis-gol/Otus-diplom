

роуты:

0. Ресурсные контроллеры. CRUD для сущностей: 
    ```
    - Student (студент)
    - Task (задание)
    - Achievement (достижение)
    - Skill (навык)

    ```
0. Отправка в сервис заданий, выполненных студентом
    ```
    POST /api/interaction/sendTask

    Формат запроса:
    {
        "student_id": 3,
        "task_id":6,
        "point": 4,
        "completed_date": "2020-16-02"
    }

    Формат ответа:
    200 (успешно):  
    {
       "message": "queued"
    }
    400 (ошибка):  
    - студента не существует
    - задания не существует
    - неправильный формат даты
    - превышено максимальное количество баллов по этому заданию
    ```

0. Запрос агрегированных результатов:
    - по студенту
        - средний балл студента по всем выполненным заданиям  
        баллы возвращаются числом 0...1 (формат float, точность 2 знака после запятой)
        ```
        GET /api/getData/Student/{STUDENT_ID}/gradePointAverage
        
        Формат ответа:
        {
              "student_id": 3,
              "average_points": 0.68,
              "number_completed_tasks": 4
        }
      
        ```
        - суммарное значение по всем навыкам студента
        ```
        GET /api/getData/Student/{STUDENT_ID}/skillLevels
        
        Формат ответа:
        {
            "student_id": 2,
            "average_points": [
                {
                    "skill_id": 2,
                    "name": "Говорение",
                    "sum": 0.2
                },
                {
                    "skill_id": 3,
                    "name": "Письменная речь",
                    "sum": 56.8
                }
            ]
        }
        ```
      
        - список достижений студента
        ```
        GET /api/getData/Student/{STUDENT_ID}/achievements
        
        Формат ответа:
        {
            "student_id": 3,
            "count_of_achievements": 2,
            "achievement_list": [
                {
                    "id": 1,
                    "name": "Простой орел",
                    "description": "Средний балл не ниже 3",
                    "completed_date": "2020-01-02"
                },
                {
                    "id": 4,
                    "name": "Занятый",
                    "description": "Провел 10 часов за уроками",
                    "completed_date": "2020-02-21"
                }
            ]
        }
        ```
        
    - по курсу
        - В РАЗРАБОТКЕ
    - по навыку
        - В РАЗРАБОТКЕ
