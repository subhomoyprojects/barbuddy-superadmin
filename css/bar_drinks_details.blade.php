<div class="liquor-holder">
	<!-- Liquor Holder Start -->
	<div class="category-menu-and-subcatagory-menu-holder">
        <div class="add-drink-back-button-holder">
            <button class="btn btn-basic-custom liquor-special-holder-show" id="drindetkbck_btn" >Back</button>
        </div>
	   <ul class="nav nav-pills category-menu-holder" id="pills-tab" role="tablist">
            @if( !empty($allsubcategories) )
                @foreach( $allsubcategories as $subcategory )
                <?php
                   $s_c_id = $subcategory['id'];
                    $has_none = (!isset($all_data[$s_c_id]['none']) && !isset($all_global_drinks[$s_c_id]['none'])) ? 'false' :'true' ;
                ?>
                <li class="nav-item">
                    <a class="nav-link drinks_sub_cat " id="pills-drinks-cat{{$subcategory['id']}}" has_none="{{$has_none}}" subcat_id="{{$subcategory['id']}}" sub_cat_id="{{$subcategory['id']}}" data-toggle="pill" href="#pills-cat{{$subcategory['id']}}" role="tab" aria-controls="pills-cat{{$subcategory['id']}}" aria-selected="false">{{$subcategory['name']}}</a>
                    @if($subcategory['added_by'] == 1 )
                        <button type="button" data-toggle="modal" data-target="#deletesuremessage" class="delete-sub-category-beer-liquor-btn remove_subcat_btn_class" sub_cat_id="{{$subcategory['id']}}">X</button>
                    @endif
                </li>
                @endforeach
            @endif
		  <li>
			 <button type="button" class="add-another-sub-category-btn"  data-toggle="modal" data-target="#addsubCategory" id="appenditemid">Add Another Sub Category</button>
          </li>
       </ul>

        <!-- <div class="add-drink-back-button-holder">
            <button class="btn btn-basic-custom liquor-special-holder-show" id="drindetkbck_btn" >Back</button>
            <button type="button" class="btn btn-success-custom float-right" data-toggle="modal" data-target="#adddrinkmanually">+ Add Drink</button>
        </div>     -->
        <div class="add-drink-back-button-holder text-right">
            <button type="button" class="btn btn-success-custom" data-toggle="modal" data-target="#adddrinkmanually">+ Add Drink</button>
        </div> 

       <p class="text-center" id = 'del_subcatsuccessmsg' style="font-size: 14px;color: #008e1b; word-wrap:break-word;" > </p>
       <p class="text-center" id ='del_subcaterrormsg' style="font-size: 14px;color: rgb(226, 12, 12);font-weight: unset;word-wrap:break-word;" > </p>
	</div>
	<div class="drink-category-special-holder">
	   <div class="tab-content" id="pills-tabContent">

            @if( !empty($allsubcategories) )
                @foreach( $allsubcategories as $sub_cat_id => $subcategory )
                <div class="tab-pane fade grand_drinks_sub_cat_div" id="pills-cat{{$subcategory['id']}}" role="tabpanel" aria-labelledby="pills-drinks-cat{{$subcategory['id']}}">
                   @if(isset($all_data[$sub_cat_id] ))
                    <!-- Verticle Tab Start -->
                    <div class="row verticle-tab-controller">
                        <?php $column_number = '12';?>
                        @if(!isset($all_data[$sub_cat_id]['none']))
                            <?php $column_number = '9';?>
                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 verticle-tab-menu-holder">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    @foreach($all_data[$sub_cat_id]  as $subcat_id=>$container_data )
                                        <a class="nav-link grand_drinks_sub_cat grand_sub_cat_{{$subcategory['id']}}" id="v-pills-sub-category{{$subcat_id}}" subcat_id="{{$subcat_id}}"  data-toggle="pill" href="#v-pills-sub-cat{{$subcat_id}}" role="tab" aria-controls="v-pills-sub-cat{{$subcat_id}}" aria-selected="true">{{ $drink_category_details[$subcat_id] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12 col-md-{{$column_number}} col-lg-{{$column_number}} col-xl-{{$column_number}} verticle-tab-description-holder">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach($all_data[$sub_cat_id]  as $subcat_id=>$container_data )
                                    <?php $grand_child_cat_id = $subcat_id; ?>
                                    @if($subcat_id == 'none')
                                        <?php $subcat_id = $subcategory['id'].$subcat_id; ?>
                                    @endif
                                    <div class="tab-pane fade grand_drink_details_div" id="v-pills-sub-cat{{$subcat_id}}" role="tabpanel" aria-labelledby="v-pills-sub-category{{$subcat_id}}">
                                        <div class="sub-tab-category-holder">
                                            <ul class="nav nav-pills glass-bottle-holder" id="pills-tab{{$subcat_id}}" role="tablist">
                                            @foreach($container_data  as $container=>$drinks_data )
                                                <li class="nav-item">
                                                    <a class="nav-link drink_container drink_cont_{{$subcat_id}}" id="pills-glass-bootle{{$subcat_id}}{{$container}}" data-toggle="pill" href="#pills-glass{{$subcat_id}}{{$container}}" role="tab" aria-controls="pills-glass{{$subcat_id}}{{$container}}" aria-selected="false" sub_cat_id="{{$sub_cat_id}}" grand_child_cat_id="{{$grand_child_cat_id}}" container_id="{{$container_details[$container]['container_id']}}">
                                                        <span class=" {{$container_details[$container]['container_icon']}} "></span>{{$container}}
                                                    </a>
                                                </li>
                                            @endforeach
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent{{$subcat_id}}">
                                                @foreach($container_data  as $container=>$drinks_data )
                                                    <div class="tab-pane fade drink_details_div" id="pills-glass{{$subcat_id}}{{$container}}" role="tabpanel" aria-labelledby="pills-glass-bootle{{$subcat_id}}{{$container}}">
                                                        <div class="select-all-drinks-filter-holder">
                                                            <!--Select All Filter Box Start-->
                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 glass-bottle-filter-selectall-controller">
                                                                    <div class="custom_check_and_radio deactive-color-mode vertical-40 selectAllDrink" >
                                                                        <input type="checkbox" class="select_all_checkbox" id="select_all_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}" drink_cat_id_ajx="{{$drink_cat_id}}" drink_sub_cat_ajx_id="{{$sub_cat_id}}" drink_grand_sub_cat_id="{{$grand_child_cat_id}}" container_name="{{$container}}" >
                                                                        <label for="select_all_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">Select All</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 glass-bottle-filter-selectall-searchbox-controller">
                                                                    <label for="all_price_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">Apply price for selected items</label>
                                                                    <input type="number" placeholder="$" id="all_price_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">
                                                                    <button type="button" class="add-category-model-opaner apply-btn apply_all_price_btn" drink_sub_cat_ajx_id="{{$sub_cat_id}}" drink_grand_sub_cat_id="{{$grand_child_cat_id}}" container_name="{{$container}}" >Apply</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--Select All Filter Box End-->
                                                        <div class="drink-price-menual-enter-holder">
                                                            <!--Drink Price Menual Enter-->
                                                            <div class="row drink_container_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">
                                                            @foreach($drinks_data  as $drinks=>$all_drinks_data )
                                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 margin_top_10 drink-price-menual-enter-controller">
                                                                    <div class="row custom_check_and_radio deactive-color-mode vertical-40" >
                                                                        <div class="col-12 col-sm-6">
                                                                            <?php                                                                               
                                                                                $checked        = ($all_drinks_data->drink_is_activated == 1) ? ' checked="checked" ' : "";
                                                                                $global_status  = ($all_drinks_data->is_global_fk_id != -1) ? 'false' : 'true';
                                                                            ?>
                                                                            <input is_global="{{$global_status}}" type="checkbox" id="{{$all_drinks_data->drink_id}}" drink_id="{{$all_drinks_data->drink_id}}" class="checked-enabel drink_checkbox" {{$checked}} value="{{$all_drinks_data->drink_id}}" >
                                                                            <label for="{{$all_drinks_data->drink_id}}" class="checked-enabel">
                                                                            {{$all_drinks_data->drink_name}}
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 price-icon-and-input-controller-of-drink">
                                                                            <div><input type="text" placeholder="Enter Price" value="{{$all_drinks_data->price}}" class="deactive-box drink_price_{{$all_drinks_data->drink_id}}" ></div>
                                                                            <div>
                                                                                @if($all_drinks_data->is_global_fk_id == 0 )
                                                                                <i class="fa fa-trash drink-price-delete-icon-controller remove_drink_class" aria-hidden="true" style="color:red;" title="Remove this drink" id="removeDrink_btn" drink_id="{{$all_drinks_data->drink_id}}" drink_cat_id_ajx="{{$drink_cat_id}}" drink_sub_cat_ajx_id="" drink_type_id="" container_name="" ></i>
                                                                                <i class="fa fa-edit drink-price-edit-icon-controller" style="color:green" data-toggle="modal" data-target="#editdrinkmanually" id="load_drink_info_btn" drink_id="{{$all_drinks_data->drink_id}}" ></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                        <!--Drink Price Menual Enter-->
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Verticle Tab End -->
        
                    @else

                        @if(isset($all_global_drinks[$sub_cat_id] ))
                        
                        <!-- global drink available -->

                        <!-- Verticle Tab Start -->
                        <div class="row verticle-tab-controller">
                            <?php $column_number = '12';?>
                            @if(!isset($all_global_drinks[$sub_cat_id]['none']))
                                <?php $column_number = '9';?>
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 verticle-tab-menu-holder">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @foreach($all_global_drinks[$sub_cat_id]  as $subcat_id=>$container_data )
                                            <a class="nav-link grand_drinks_sub_cat grand_sub_cat_{{$subcategory['id']}}" id="v-pills-sub-category{{$subcat_id}}" subcat_id="{{$subcat_id}}" data-toggle="pill" href="#v-pills-sub-cat{{$subcat_id}}" role="tab" aria-controls="v-pills-sub-cat{{$subcat_id}}" aria-selected="true">{{$global_drink_category_details[$subcat_id]}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="col-sm-12 col-md-{{$column_number}} col-lg-{{$column_number}} col-xl-{{$column_number}} verticle-tab-description-holder">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @if(isset($all_global_drinks[$sub_cat_id]))
                                        @foreach($all_global_drinks[$sub_cat_id]  as $subcat_id=>$container_data )
                                            <?php $grand_child_cat_id = $subcat_id; ?>
                                            @if($subcat_id == 'none')
                                                <?php $subcat_id = $subcategory['id'].$subcat_id; ?>
                                            @endif
                                            <div class="tab-pane fade grand_drink_details_div" id="v-pills-sub-cat{{$subcat_id}}" role="tabpanel" aria-labelledby="v-pills-sub-category{{$subcat_id}}">
                                                <div class="sub-tab-category-holder">
                                                    <ul class="nav nav-pills glass-bottle-holder" id="pills-tab{{$subcat_id}}" role="tablist">
                                                    @foreach($container_data  as $container=>$drinks_data )
                                                        <li class="nav-item">
                                                            <a class="nav-link drink_container drink_cont_{{$subcat_id}}" id="pills-glass-bootle{{$subcat_id}}{{$container}}" data-toggle="pill" href="#pills-glass{{$subcat_id}}{{$container}}" role="tab" aria-controls="pills-glass{{$subcat_id}}{{$container}}" aria-selected="false" container_id="{{$container}}" >
                                                                <span class="{{$global_container_details[$container]['container_icon']}}"></span>{{$container}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    <div class="tab-content" id="pills-tabContent{{$subcat_id}}">
                                                        @foreach($container_data  as $container=>$drinks_data )
                                                            <div class="tab-pane fade drink_details_div" id="pills-glass{{$subcat_id}}{{$container}}" role="tabpanel" aria-labelledby="pills-glass-bootle{{$subcat_id}}{{$container}}">
                                                                <div class="select-all-drinks-filter-holder">
                                                                    <!--Select All Filter Box Start-->
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 glass-bottle-filter-selectall-controller">
                                                                            <div class="custom_check_and_radio deactive-color-mode vertical-40 selectAllDrink" >
                                                                                <input type="checkbox" class="select_all_checkbox" id="select_all_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}" drink_cat_id_ajx="{{$drink_cat_id}}" drink_sub_cat_ajx_id="{{$sub_cat_id}}" drink_grand_sub_cat_id="{{$grand_child_cat_id}}" container_name="{{$container}}" >
                                                                                <label for="select_all_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">Select All</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 glass-bottle-filter-selectall-searchbox-controller">
                                                                            <label for="all_price_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">Apply price for selected items</label>
                                                                            <input type="number" placeholder="$" id="all_price_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">
                                                                            <button type="button" class="add-category-model-opaner apply-btn apply_all_price_btn" drink_sub_cat_ajx_id="{{$sub_cat_id}}" drink_grand_sub_cat_id="{{$grand_child_cat_id}}" container_name="{{$container}}" >Apply</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--Select All Filter Box End-->
                                                                <div class="drink-price-menual-enter-holder">
                                                                    <!--Drink Price Menual Enter-->
                                                                    <div class="row drink_container_{{$sub_cat_id}}_{{$grand_child_cat_id}}_{{$container}}">

                                                                    @foreach($drinks_data  as $drinks=>$all_drinks_data )
                                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 margin_top_10 drink-price-menual-enter-controller">
                                                                            <div class="row custom_check_and_radio deactive-color-mode vertical-40" >
                                                                                <div class="col">
                                                                                    <input is_global="true" type="checkbox" id="{{$all_drinks_data->drink_id}}" drink_id="{{$all_drinks_data->drink_id}}" class="checked-enabel drink_checkbox" value="{{$all_drinks_data->drink_id}}" >
                                                                                    <label for="{{$all_drinks_data->drink_id}}" class="checked-enabel">
                                                                                    {{$all_drinks_data->drink_name}}
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="text" placeholder="Enter Price" value="{{$all_drinks_data->price}}" class="deactive-box drink_price_{{$all_drinks_data->drink_id}}" >
                                                                                    <!-- <i class="fa fa-trash" aria-hidden="true" style="color:red;" title="Remove this drink" id="removeDrink_btn" drink_id="{{$all_drinks_data->drink_id}}" ></i>
                                                                                    <i class="fa fa-edit" style="color:green"></i> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                                <!--Drink Price Menual Enter-->
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                         <!-- Verticle Tab End -->
               
                         @else

                         <!-- no global drinks -->

                         @endif

                   @endif

                    <p class="text-center" id = 'delsuccessmsg' style="font-size: 14px;color: #008e1b; word-wrap:break-word;" ></p>
                    <p class="text-center" id ='delerrormsg' style="font-size: 14px;color: rgb(226, 12, 12);font-weight: unset;word-wrap:break-word;" ></p>

                   <!--Drink Price Menual Enter-->
                   
                </div>

                @endforeach

                <div class="row margin_top_50 saveDrinkChange_btn_container" style="display:none;">
                    <div class="col-12"><button class="add-category-model-opaner center-x" id="saveDrinkChange_btn" drink_cat_id_ajx="{{$drink_cat_id}}" drink_sub_cat_ajx_id="" drink_type_id="" container_name="" >Save Changes</button></div>
                    <div class="col-12 add-drink-back-button-holder">
                        <button class="btn btn-basic-custom liquor-special-holder-show" id="drindetkbck_btn" >Back</button>
                        <button type="button" class="btn btn-success-custom float-right" data-toggle="modal" data-target="#adddrinkmanually">+ Add Drink</button>
                    </div> 
                </div>
            @endif
		</div>
    </div>
  
    <p class="text-center" id = 'save_successmsg' style="font-size: 14px;color: #008e1b; word-wrap:break-word;" ></p>
    <p class="text-center" id ='save_errormsg' style="font-size: 14px;color: rgb(226, 12, 12);font-weight: unset;word-wrap:break-word;" > </p>
            
</div>
 <!-- Liquor Holder End -->

 <!-- modal begins -->

<!-- Add Drink Manually Model Start -->

<div class="modal fade add-category-model" id="adddrinkmanually" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h2>Add Drink Manually </h2> -->
            <h2> 
                Add Drink for : {{ $drink_category_selected_name }} <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="add_drink_breadcrumb"></span>
            </h2>
            <button type="button" class="close red-cross-btn" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="happy_hours_form_holder add-drink-manually-form-holder">

                <input id="baridforsubcat" type="hidden" value="{{ $bar_id }}" >

                <ul class="form_holder">
                    <li class="no_border">
                        <div class="quarter quarter-3 margin_right_30">
                            <input placeholder="Drink Name" type="text" id="adddrinkName" >
                        </div>
                        <div class="quarter">
                            <input placeholder="Price" type="number" id="adddrinkPrice" >
                        </div>
                    </li>
                    <li>
                        <textarea placeholder="Short Description" id="adddrinkShortDesc"></textarea>
                    </li>

                    <!-- <li class="no_border">
                        <div class="half tringle_arrow margin_right_30">
                            <select id="addDrinksCat">
                                <option selected="true" disabled="disabled">Category</option>  
                                @foreach( $all_drink_categories as $category )
                                    <option value="{{ $category->id }}" > {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="half tringle_arrow" >
                            <select id="addDrinksSubCat" > </select>
                        </div>
                    </li> -->

                    <!-- <li>
                        <div class="tringle_arrow ">
                            <select id="addDrinkGrandCat"> </select>
                        </div>
                    </li> -->
                    
                    <li class="no_border custom_check_and_radio" id="addDrinkContainer">
                        <label class="width_half margin_right_30" >Drinks Available On:</label>

                        @foreach( $allcontainers as $container )
                            <span class="check_and_radio_holder all_container_span">
                                <!-- <input id="add_container_{{ $container->id }}" value="{{ $container->id }}" container_name="{{ $container->type }}" name="add_container" type="radio" class="modal_add_container"> -->
                                <input id="add_container_{{ $container->id }}" value="{{ $container->id }}" container_name="{{ $container->type }}" name="add_container" type="checkbox" class="modal_add_container">
                                <label for="add_container_{{ $container->id }}"> {{ $container->type }} </label>
                            </span>
                        @endforeach

                    </li>
                    <!-- <li class="no_border speciality-drink-on-your-bar">
                        <div class="row">
                            <div class="col-sm-7 col-md-7">
                                <label>Is thiis is a speciality drink on your bar?</label>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <label class="switch">
                                    <input type="checkbox" checked id="addDrinkSpeciality">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </li> -->
                </ul>

            </div>
        </div>

        <div class="modal-footer">
            <div class="col btn-left"><button class="btn btn-basic-custom liquor-special-holder-show" data-dismiss="modal">Back</button></div>
            
            <p class="text-center" id = 'successmsg' style="font-size: 14px;color: #008e1b; word-wrap:break-word;" ></p>
            <p class="text-center" id ='errormsg' style="font-size: 14px;color: rgb(226, 12, 12);font-weight: unset;word-wrap:break-word;" > </p>
            
            <div class="col btn-right"><button class="btn btn-success-custom float-right" id="addDrinkbtn" drink_sub_cat_ajx_id = "" container_id="" drink_type_id="" drink_cat_id_ajx="{{$drink_cat_id}}" >Submit</button></div>
        </div>
        </div>
    </div>
</div>
    
 <!-- Add Drink Manually Model End -->


<!-- Edit Drink Manually Model Start -->

<div class="modal fade add-category-model" id="editdrinkmanually" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Your Drink </h2>
            <button type="button" class="close red-cross-btn" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="happy_hours_form_holder add-drink-manually-form-holder">

                <input id="baridforsubcat" type="hidden" value="{{ $bar_id }}" >

                <ul class="form_holder">
                    <li class="no_border">
                        <div class="quarter quarter-3 margin_right_30">
                            <input placeholder="Drink Name" type="text" id="editdrinkName" >
                        </div>
                        <div class="quarter">
                            <input placeholder="Price" type="number" id="editdrinkPrice" >
                        </div>
                    </li>
                    <li>
                        <textarea placeholder="Short Description" id="editdrinkShortDesc"></textarea>
                    </li>
                  
                    <!-- <li class="no_border custom_check_and_radio" id="editDrinkContainer" container_id="" >
                        <label class="width_half margin_right_30" >Drinks Available On:</label>

                        
                        @foreach( $allcontainers as $container )
                            <span class="check_and_radio_holder all_container_span">
                                <input id="{{ $container->id }}" value="{{ $container->id }}" type="checkbox" >
                                <label for="{{ $container->id }}"> {{ $container->type }} </label>
                            </span>
                        @endforeach

                    </li> -->

                </ul>

            </div>
        </div>

        <div class="modal-footer">
            <div class="col btn-left"><button class="btn btn-basic-custom liquor-special-holder-show" data-dismiss="modal">Back</button></div>
            
            <p class="text-center" id = 'editsuccessmsg' style="font-size: 14px;color: #008e1b; word-wrap:break-word;" ></p>
            <p class="text-center" id ='editerrormsg' style="font-size: 14px;color: rgb(226, 12, 12);font-weight: unset;word-wrap:break-word;" > </p>
            
            <div class="col btn-right"><button class="btn btn-success-custom float-right" id="editDrinkbtn" container_name="" drink_sub_cat_ajx_id = "" container_id="" drink_type_id="" drink_cat_id_ajx="{{$drink_cat_id}}" >Submit</button></div>
        </div>
        </div>
    </div>
</div>
    
 <!-- Edit Drink Manually Model End -->
 
<!-- Modal For Delete Message Start -->

<div class="modal fade add-category-model remove-p-controller " id="deletesuremessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close red-cross-btn" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to permanently remove this item? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success-custom center-x removeSubCat_btn" data-dismiss="modal" id="removeSubCat_btn" sub_cat_id = "" drink_cat_id_ajx="{{$drink_cat_id}}" >Yes</button>
    <!-- <button type="button" class="delete-sub-category-beer-liquor-btn removeSubCat_btn" title="Remove this subcategory" id="removeSubCat_btn" sub_cat_id="{{$subcategory['id']}}" drink_cat_id_ajx="{{$drink_cat_id}}">X</button> -->

        </div>
      </div>
    </div>
  </div>

<!-- Model For Delete Message End -->

 <!-- modal ends -->

