<?php if($user_level == 5){?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Добавление квеста
                    </h3>
                </div>
                <form class="add_task_form"> 

                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task">
                    </div>

                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="text" class="input_task">
                    </div>

                    <div class="wrap_input_task">
                        <div class="inp_add_name">Время(мин)</div>
                        <input type="text" class="input_task">
                    </div>

                    <div class="action_num">
                        Действие №1
                    </div>

                    <div class="wrap_textarea_task">
                        <div class="textarea_name">Описание действия</div>
                        <textarea name="" id="" rows="10" class="textarea"></textarea>
                    </div>

                    <div class="wrap_textarea_task">
                        <div class="textarea_name">Контрольный вопрос</div>
                        <textarea name="" id="" rows="10" class="textarea"></textarea>
                    </div>

                    <div class="textarea_name">Варианты ответов</div>

                    <div class="wrap_input_variant_answer">
                        <div class="inp_add_name name_var1">Вариант 1</div>
                        <input type="text" class="input_task answer_var1">
                    </div>
                    <div class="wrap_input_variant_answer">
                        <div class="inp_add_name name_var2 ">Вариант 2</div>
                        <input type="text" class="input_task answer_var2">
                    </div>
                    <div class="wrap_input_variant_answer">
                        <div class="inp_add_name name_var3">Вариант 3</div>
                        <input type="text" class="input_task answer_var3">
                    </div>

                    <input type="button" class="add_action" value="Добавить действие">

                    <input type="button" class="finish_exercise" value="Отправить">
                </form>
            </div>
        </div>
    </div>
</section>
<?}?>