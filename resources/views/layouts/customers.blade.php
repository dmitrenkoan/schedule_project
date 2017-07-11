@extends('template')

@section('content')
    <section class="main-content">
        <div class="js-loading-image" id="loading_image" style="display: none">
            <i class="icon-refresh icon-spin"></i>
            Loading...
        </div>


        <div class="components-Inventory-components-Index___container___Fqh7F">
            <div class="components-Inventory-components-Products-ProductList___navbar___1AYlq">
                <!--<span class="components-Inventory-components-Products-ProductList___dropdown___2mHp5 components-Select-Select___self___13CJj components-Select-Select___withCollapse___2isrU components-Select-Select___medium___2szG9" style="max-width: 240px;">
                    <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD components-Button-Button___medium___2jLbJ" data-link="/inventory/issue_invantary_form" data-type="update">
                        <span class="components-Button-Button___children-collapse___1zj0X components-Button-Button___medium___2jLbJ">
                            Выдать инвентарь
                        </span>
                        <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Button-Button___icon-collapse___3PKkW components-Button-Button___medium___2jLbJ"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill-rule="evenodd" d="M26 22V8c0-1.11-.895-2-2-2-1.112 0-2 .895-2 2v14H8c-1.11 0-2 .895-2 2 0 1.112.895 2 2 2h14v14c0 1.11.895 2 2 2 1.112 0 2-.895 2-2V26h14c1.11 0 2-.895 2-2 0-1.112-.895-2-2-2H26z"></path></svg></span>
                    </button>
                </span>-->
                <div class="components-Inventory-components-Products-ProductList___navbar-separator___3dHh6 components-Inventory-styles-common___navbar-separator___3fi_q"></div>
                <div class="components-Inventory-components-Products-ProductList___newProduct___OxZa4">
                    <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD components-Button-Button___medium___2jLbJ" data-action="open-modal">
                                                       <span class="components-Button-Button___children-collapse___1zj0X components-Button-Button___medium___2jLbJ">
                                                           Новый клиент
                                                       </span>
                        <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Button-Button___icon-collapse___3PKkW components-Button-Button___medium___2jLbJ"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill-rule="evenodd" d="M26 22V8c0-1.11-.895-2-2-2-1.112 0-2 .895-2 2v14H8c-1.11 0-2 .895-2 2 0 1.112.895 2 2 2h14v14c0 1.11.895 2 2 2 1.112 0 2-.895 2-2V26h14c1.11 0 2-.895 2-2 0-1.112-.895-2-2-2H26z"></path></svg></span>
                    </button>
                </div>
            </div>
            @if(!empty($arResult))
            <div class="row m-t-20 clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12" id="customers_list"><div class="table-responsive">
                        <table class="table table-hover table-sortable">
                            <thead>
                            <tr>
                                <th><a >Имя</a></th>
                                <th><a >Телефон</a></th>
                                <th><a >Email</a></th>
                                <th><a >Пол</a></th>
                            </tr>
                            </thead>
                            <tbody data-type="insert-target">
                            @foreach($arResult as $arClient)
                            <tr class="clickable-row" data-href="/customers/update/{{$arClient['id']}}">
                                <td>{{$arClient['name']}}</td>
                                <td>{{$arClient['phone']}}</td>
                                <td>{{$arClient['email']}}</td>
                                <td>
                                    {{$arClient['sex']}}
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container">

                        <div class="pagination-info paging">Displaying <b>all {{count($arResult)}}</b> clients</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

        <div class="components-Modal-Modal___background___59VHw" id="modal_window" style="display:none">
            <div class="components-Modal-Modal___container___3mETe components-Modal-Modal___large___28vxo">
                <div class="components-Loader-Loader___self___sERCy">
                    <div class="components-Loader-Loader___children___1nSg3">
                        <div class="components-Modal-Header___self___3YXP4">Новый клиент</div>
                        <div class="components-Modal-Content___self___1m6Do"><div>
                                <div class="components-Form-FormGroup___self___tyZ1F">
                                    <div class="components-Form-FormGroup___flex___3Lzrh">
                                        <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                            <div class="components-Form-FormField___self___10VZD">
                                                <label class="components-Form-FormField___label___1NQ5t" for="name">ФИО</label>
                                                <div class="components-Input-Input___self___2cl9W">
                                                    <div class="components-Input-Input___container___2dCSs">
                                                        <input id="name" type="text" name="name" class="components-Input-Input___input___1fuFB" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="components-Form-FormField___self___10VZD">
                                                <label class="components-Form-FormField___label___1NQ5t" for="phone">Телефон</label>
                                                <div class="components-Input-Input___self___2cl9W">
                                                    <div class="components-Input-Input___container___2dCSs">
                                                        <input id="phone" type="text" name="phone" class="components-Input-Input___input___1fuFB" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="components-Form-FormField___self___10VZD">
                                                <label class="components-Form-FormField___label___1NQ5t" for="email">Email</label>
                                                <div class="components-Input-Input___self___2cl9W">
                                                    <div class="components-Input-Input___container___2dCSs">
                                                        <input id="email" type="email" name="email" class="components-Input-Input___input___1fuFB" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="components-Form-FormField___self___10VZD">
                                                <div class="form-group no-margin">
                                                    <span class="radio radio-success inline no-margin md-m-b-10"><input type="radio" value="male" name="sex" id="customer_gender_male">
                                                        <label class="collection_radio_buttons" for="customer_gender_male">Мужчина</label>
                                                    </span>
                                                    <span class="radio radio-success inline no-margin md-m-b-10">
                                                        <input type="radio" value="female" name="sex" id="customer_gender_female">
                                                        <label class="collection_radio_buttons" for="customer_gender_female">Женщина</label></span>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                            <div class="components-Form-FormGroup___self___tyZ1F">
                                                <div class="components-Form-FormGroup___flex___3Lzrh">
                                                    <div class="components-Form-FormGroupCol___self___2sGrM">

                                                        <div class="components-Form-FormField___self___10VZD" style="height:200px;">
                                                            <label class="components-Form-FormField___label___1NQ5t" for="customer_text">Дополнительные заметки о клиенте</label>
                                                            <div class="components-Input-Input___self___2cl9W">
                                                                <div class="components-Input-Input___container___2dCSs">
                                                                    <textarea rows="10" class="text optional form-control" placeholder="Добавьте дополнительную информацию о клиенте(не обязательно)" name="note" id="customer_text"></textarea>
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
                                                                            <select name="birthday_month" id="customer_birthday_month" class="full-width no-error middle-item form-control" required="required"><option value="">Select month</option><option value="1">Январь</option>
                                                                                <option value="2">Февраль</option>
                                                                                <option value="3">Март</option>
                                                                                <option value="4">Апрель</option>
                                                                                <option value="5">Май</option>
                                                                                <option value="6">Июнь</option>
                                                                                <option value="7">Июль</option>
                                                                                <option value="8">Август</option>
                                                                                <option value="9">Сентябрь</option>
                                                                                <option value="10">Октябрь</option>
                                                                                <option value="11">Ноябрь</option>
                                                                                <option value="12">Декабрь</option>
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
                                                                                <option value="{{$day}}">{{$day}}</option>
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
                        <div class="components-Modal-Footer___self___1LdZR">
                            <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD" data-type="submit" data-target="/clients/new">
                                Сохранить
                            </button>
                            <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-default___3bmdJ">
                                Отмена
                            </button>
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
        </div>
        <footer></footer>
    </section>
@endsection