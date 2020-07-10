<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createStudentTable();
        $this->createAchievementTable();
        $this->createCourseTable();
        $this->createGroupTable();
        $this->createLessonTable();
        $this->createTaskTable();
        $this->createSkillTable();
        $this->createStudentAchievementTable();
        $this->createStudentGroupTable();
        $this->createTaskStudentTable();
        $this->createTaskSkillTable();
        $this->createSkillLevel();
        $this->createStudentSkill();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_skill');
        Schema::dropIfExists('skill_level');
        Schema::dropIfExists('task_skill');
        Schema::dropIfExists('task_student');
        Schema::dropIfExists('student_group');
        Schema::dropIfExists('student_achievement');
        Schema::dropIfExists('skill');
        Schema::dropIfExists('task');
        Schema::dropIfExists('lesson');
        Schema::dropIfExists('group');
        Schema::dropIfExists('course');
        Schema::dropIfExists('achievement');
        Schema::dropIfExists('student');

    }

    protected function createStudentTable(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    protected function createCourseTable()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createLessonTable()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('goal');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('course');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createTaskTable()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('max_point');
            $table->integer('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lesson');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createGroupTable()
    {
        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('course');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createStudentGroupTable()
    {
        Schema::create('student_group', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('student_id');
            $table->foreign('group_id')->references('id')->on('group');
            $table->foreign('student_id')->references('id')->on('student');
        });
    }

    protected function createTaskStudentTable()
    {
        Schema::create('task_student', function (Blueprint $table) {
            $table->integer('point');
            $table->date('completed_date');
            $table->integer('student_id');
            $table->integer('task_id');
            $table->unique(['student_id', 'task_id']);
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('task_id')->references('id')->on('task');
        });
    }

    protected function createSkillTable()
    {
        Schema::create('skill', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createTaskSkillTable()
    {
        Schema::create('task_skill', function (Blueprint $table) {
            $table->integer('percent_for_skill');
            $table->integer('task_id');
            $table->integer('skill_id');
            $table->unique(['skill_id', 'task_id']);
            $table->foreign('task_id')->references('id')->on('task');
            $table->foreign('skill_id')->references('id')->on('skill');
        });
    }

    protected function createAchievementTable()
    {
        Schema::create('achievement', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('discriminator');
            $table->string('threshold');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createStudentAchievementTable()
    {
        Schema::create('student_achievement', function (Blueprint $table) {
            $table->date('completed_date');
            $table->integer('student_id');
            $table->integer('achievement_id');
            $table->unique(['student_id', 'achievement_id']);
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('achievement_id')->references('id')->on('achievement');
        });
    }

    protected function createSkillLevel()
    {
        Schema::create('skill_level', function (Blueprint $table) {
            $table->id();
            $table->integer('skill_id');
            $table->string('name');
            $table->string('description');
            $table->integer('threshold');
            $table->foreign('skill_id')->references('id')->on('skill');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    protected function createStudentSkill()
    {
        Schema::create('student_skill', function (Blueprint $table) {
            $table->float('points');
            $table->integer('student_id');
            $table->integer('skill_id');
            $table->unique(['student_id', 'skill_id']);
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('skill_id')->references('id')->on('skill');
        });
    }

}
