<div class="components-Modal-Modal___container___3mETe components-Modal-Modal___large___28vxo">
    <div class="components-Loader-Loader___self___sERCy">
        <div class="components-Loader-Loader___children___1nSg3">
            <div class="components-Modal-Header___self___3YXP4">Клиент: {{$client->name}}</div>
            <div class="components-Modal-Content___self___1m6Do"><div>
                    <div class="components-Form-FormGroup___self___tyZ1F">
                        <div class="components-Form-FormGroup___flex___3Lzrh">
                            <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                <div class="components-Form-FormField___self___10VZD">
                                    <label class="components-Form-FormField___label___1NQ5t" for="name">ФИО</label>
                                    <div class="components-Input-Input___self___2cl9W">
                                        <div class="components-Input-Input___container___2dCSs">
                                            <input id="name" type="text" name="name" class="components-Input-Input___input___1fuFB" placeholder="" value="{{$client->name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="components-Form-FormField___self___10VZD">
                                    <label class="components-Form-FormField___label___1NQ5t" for="phone">Телефон</label>
                                    <div class="components-Input-Input___self___2cl9W">
                                        <div class="components-Input-Input___container___2dCSs">
                                            <input id="phone" type="text" name="phone" class="components-Input-Input___input___1fuFB" placeholder="" value="{{$client->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="components-Form-FormField___self___10VZD">
                                    <label class="components-Form-FormField___label___1NQ5t" for="email">Email</label>
                                    <div class="components-Input-Input___self___2cl9W">
                                        <div class="components-Input-Input___container___2dCSs">
                                            <input id="email" type="email" name="email" class="components-Input-Input___input___1fuFB" placeholder="" value="{{$client->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="components-Form-FormField___self___10VZD">
                                    <div class="form-group no-margin">
                                                    <span class="radio radio-success inline no-margin md-m-b-10">
                                                        <input type="radio" value="М" name="sex" id="customer_gender_male_update" {{$client->sex == "М" ? "checked" : ''}}>
                                                        <label class="collection_radio_buttons" for="customer_gender_male_update">Мужчина</label>
                                                    </span>
                                        <span class="radio radio-success inline no-margin md-m-b-10">
                                                        <input type="radio" value="Ж" name="sex" id="customer_gender_female_update" {{$client->sex == "Ж" ? "checked" : ''}}>
                                                        <label class="collection_radio_buttons" for="customer_gender_female_update">Женщина</label></span>
                                    </div>
                                </div>

                                <div class="components-Form-FormField___self___10VZD">
                                    <label class="components-Form-FormField___label___1NQ5t" >Бонусы</label>
                                    <div class="components-Input-Input___self___2cl9W">
                                        <div class="components-Input-Input___container___2dCSs">
                                            <input disabled class="components-Input-Input___input___1fuFB" placeholder="" value="{{!empty($client->bonus->balance) ? $client->bonus->balance: 0}}">

                                        </div>


                                    </div>
                                    <div class=" margin-top">
                                        <button class="btn btn-success js-add-shift" id="add_client_bonus" data-action="show">Добавить</button>
                                        <div class="add-bonus" style="display:none">
                                            <div class="components-Input-Input___container___2dCSs ">
                                                <label class="components-Form-FormField___label___1NQ5t" for="add_bonus_value">Количество</label>
                                                <input id="add_bonus_value" name="add_bonus_value" class="components-Input-Input___input___1fuFB" placeholder="" value="">
                                                <label class="components-Form-FormField___label___1NQ5t " for="add_bonus_value_comment">Коментарий</label>
                                                <textarea class="full-width-popup" name="add_bonus_value_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" margin-top">
                                        <button class="btn btn-danger js-add-shift" id="reduce_client_bonus" data-action="show">Списать</button>
                                        <div class="reduce-bonus" style="display:none">
                                            <div class="components-Input-Input___container___2dCSs ">
                                                <label class="components-Form-FormField___label___1NQ5t" for="reduce_bonus_value">Количество</label>
                                                <input id="reduce_bonus_value" name="reduce_bonus_value" class="components-Input-Input___input___1fuFB" placeholder="" value="">
                                                <label class="components-Form-FormField___label___1NQ5t" for="reduce_bonus_value_comment">Коментарий</label>
                                                <textarea class="full-width-popup" name="reduce_bonus_value_comment"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                <div class="components-Form-FormGroup___self___tyZ1F">
                                    <div class="components-Form-FormGroup___flex___3Lzrh">
                                        <div class="components-Form-FormGroupCol___self___2sGrM">

                                            <div class="components-Form-FormField___self___10VZD" style="height:200px;">
                                                <label class="components-Form-FormField___label___1NQ5t" for="customer_text_update">Дополнительные заметки о клиенте</label>
                                                <div class="components-Input-Input___self___2cl9W">
                                                    <div class="components-Input-Input___container___2dCSs">
                                                        <textarea rows="10" class="text optional form-control" placeholder="Добавьте дополнительную информацию о клиенте(не обязательно)" name="note" id="customer_text_update">{{$client->note}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="birthday customer_birthday form-group">
                                                <label class="block">
                                                    <span class="translation_missing" title="translation missing: en.customers.form.lables.birthday">День рождения</span>
                                                </label>
                                                <div class="row attached-fields">
                                                    <div class="col-xs-4">
                                                        <div class="form-group no-padding no-margin">
                                                            <div class="select-wrapper">
                                                                <select name="birthday_month" id="customer_birthday_month" class="full-width no-error middle-item form-control" required="required"><option value="">Select month</option>
                                                                    @foreach($arMonth as $month => $monthTitle)
                                                                        <option value="{{$month}}" {{$arBirtday['month'] == $month ? "selected" : ''}}>{{$monthTitle}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 ">
                                                        <div class="form-group no-padding no-margin" id="month-group">
                                                            <div class="select-wrapper">
                                                                <select name="birthday_day" id="customer_birthday_day" class="full-width form-control" required="required">
                                                                    <option value="">Выберите день</option>
                                                                    @for($day=1;$day<32;$day++)
                                                                        <option value="{{$day}}" {{$day == $arBirtday['day'] ? "selected" : ""}}>{{$day}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>






                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD" data-type="update_submit" data-target="/customers/update/{{$client->id}}" data-insert="client_{{$client->id}}">
                    Сохранить
                </button>
                <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-default___3bmdJ">
                    Отмена
                </button>
                <div class="pull-left">
                    <a class="btn btn-danger" data-target="/customers/delete/{{$client->id}}" data-type="delete" data-insert="client_{{$client->id}}">Удалить</a>
                </div>
                <div class="components-Modal-Footer___separator___2GWXg"></div>
            </div>
        </div>
        <div class="components-Loader-Loader___loader___1VV5C">
            <div class="components-Loader-Loader___content___kkYiB components-Loader-Loader___fixed-mobile___p3_Q8"><span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Loader-Loader___spin-icon___3FhUU components-Icon-Icon___spin___3z9Wi components-Icon-Icon___size-small___3MFdj"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 438.529 438.528" style="enable-background:new 0 0 438.529 438.528;" xml:space="preserve"><path d="M433.109,23.694c-3.614-3.612-7.898-5.424-12.848-5.424c-4.948,0-9.226,1.812-12.847,5.424l-37.113,36.835 c-20.365-19.226-43.684-34.123-69.948-44.684C274.091,5.283,247.056,0.003,219.266,0.003c-52.344,0-98.022,15.843-137.042,47.536 C43.203,79.228,17.509,120.574,5.137,171.587v1.997c0,2.474,0.903,4.617,2.712,6.423c1.809,1.809,3.949,2.712,6.423,2.712h56.814 c4.189,0,7.042-2.19,8.566-6.565c7.993-19.032,13.035-30.166,15.131-33.403c13.322-21.698,31.023-38.734,53.103-51.106 c22.082-12.371,45.873-18.559,71.376-18.559c38.261,0,71.473,13.039,99.645,39.115l-39.406,39.397 c-3.607,3.617-5.421,7.902-5.421,12.851c0,4.948,1.813,9.231,5.421,12.847c3.621,3.617,7.905,5.424,12.854,5.424h127.906 c4.949,0,9.233-1.807,12.848-5.424c3.613-3.616,5.42-7.898,5.42-12.847V36.542C438.529,31.593,436.733,27.312,433.109,23.694z"></path><path d="M422.253,255.813h-54.816c-4.188,0-7.043,2.187-8.562,6.566c-7.99,19.034-13.038,30.163-15.129,33.4 c-13.326,21.693-31.028,38.735-53.102,51.106c-22.083,12.375-45.874,18.556-71.378,18.556c-18.461,0-36.259-3.423-53.387-10.273 c-17.13-6.858-32.454-16.567-45.966-29.13l39.115-39.112c3.615-3.613,5.424-7.901,5.424-12.847c0-4.948-1.809-9.236-5.424-12.847 c-3.617-3.62-7.898-5.431-12.847-5.431H18.274c-4.952,0-9.235,1.811-12.851,5.431C1.807,264.844,0,269.132,0,274.08v127.907 c0,4.945,1.807,9.232,5.424,12.847c3.619,3.61,7.902,5.428,12.851,5.428c4.948,0,9.229-1.817,12.847-5.428l36.829-36.833 c20.367,19.41,43.542,34.355,69.523,44.823c25.981,10.472,52.866,15.701,80.653,15.701c52.155,0,97.643-15.845,136.471-47.534 c38.828-31.688,64.333-73.042,76.52-124.05c0.191-0.38,0.281-1.047,0.281-1.995c0-2.478-0.907-4.612-2.715-6.427 C426.874,256.72,424.731,255.813,422.253,255.813z"></path></svg></span><!-- react-text: 423 -->Loading...<!-- /react-text -->
            </div>
        </div>
    </div>
    <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-transparent___1zjYP components-Modal-Modal___close-button___2MA_D"><span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___icon-close___2ZIGN components-Icon-Icon___color-gray___eeS_g components-Icon-Icon___size-big___2Cwmv"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path class="st0" stroke-width="1.25" d="M0 0l48 48M48 0L0 48"></path></svg></span>
    </button>
</div>