<div class="components-Modal-Modal___container___3mETe components-Modal-Modal___large___28vxo">
    <div class="components-Loader-Loader___self___sERCy">
        <div class="components-Loader-Loader___children___1nSg3">
            <div class="components-Modal-Header___self___3YXP4">Выдать инвентарь сотруднику</div>
            <div class="components-Modal-Content___self___1m6Do"><div>
                    <div class="components-Form-FormGroup___self___tyZ1F">
                        <div class="components-Form-FormGroup___flex___3Lzrh">
                            <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                <div class="components-Form-FormField___self___10VZD">
                                    <label class="components-Form-FormField___label___1NQ5t" for="productBrandId">Инвентарь</label>
                                    <span class="components-Select-Select___self___13CJj">
                                        <input type="hidden" name="item_id" value="{{$obInventory->id}}"/>
                                        <input name="inventory_name"  class="components-Input-Input___input___1fuFB" size="30" disabled="disabled" value="{{$obInventory->name}}" type="text" />

                                <!--<div class="suggestionsBox" id="suggestions" style="display: none;">
                                    <div class="suggestionList" id="autoSuggestionsList">
                                    </div>
                                </div>-->

                                    </span>
                                </div>
                                <div class="components-Form-FormField___self___10VZD">

                                    <div class="row service-pricing-level">
                                        <div class="col-sm-3 col-xs-4 col-sm-5">
                                            <label class="components-Form-FormField___label___1NQ5t" for="price">Количество</label>
                                            <div class="components-Input-Input___self___2cl9W">
                                                <div class="components-Input-Input___container___2dCSs">
                                                    <input type="number" id="transfer_quantity" name="quantity" class="components-Input-Input___input___1fuFB" placeholder="" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-4 col-sm-3" >
                                            <label class="components-Form-FormField___label___1NQ5t" for="price">Остаток</label>
                                            <div class="components-Input-Input___self___2cl9W">
                                                <div class="components-Input-Input___container___2dCSs">
                                                    <input type="number" id="block_store_value" disabled="disabled" class="components-Input-Input___input___1fuFB" placeholder="" value="{{$obInventory->quantity}}">
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($obUnitType))
                                        <div class="col-sm-3 col-xs-4 col-sm-4" >
                                            <label class="components-Form-FormField___label___1NQ5t" for="price">Еденицы измерения</label>
                                            <div class="components-Input-Input___self___2cl9W">
                                                <div class="components-Input-Input___container___2dCSs">

                                                    <input type="text" disabled="disabled"  class="components-Input-Input___input___1fuFB" placeholder="" value="{{$obUnitType->short_name}}" >
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>


                            <div class="components-Form-FormGroupCol___self___2sGrM components-Form-FormGroupCol___white-space___1Tn2L">
                                <div class="components-Form-FormGroup___self___tyZ1F">
                                    <div class="components-Form-FormGroup___flex___3Lzrh">
                                        <div class="components-Form-FormGroupCol___self___2sGrM">

                                            <div class="components-Form-FormField___self___10VZD">
                                                <label class="components-Form-FormField___label___1NQ5t" for="productBrandId">Сотрудник</label>
                                                <span class="components-Select-Select___self___13CJj">
                                                <select name="staff_id" required="" class="components-Select-Select___select___1ytQc">
                                                    <option value="">Выберите вариант</option>
                                                    @foreach($arStaff as $arStaffItem)
                                                        <option value="{{$arStaffItem->id}}" >{{$arStaffItem->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Select-Select___icon-right___1gDJ1"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path d="M24,36c-0.256,0-0.512-0.098-0.707-0.293l-22-22c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0 L24,33.586l21.293-21.293c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-22,22C24.512,35.902,24.256,36,24,36z"></path></svg></span>
                                                </span>
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
                <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD" data-type="update_submit" data-target="/employees/inventory/add" data-insert="block_{{$obInventory->id}}">
                    Сохранить
                </button>
                <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-default___3bmdJ">
                    Отменить
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
<script src="{{ asset('js/fastSearch.js')}}"></script>