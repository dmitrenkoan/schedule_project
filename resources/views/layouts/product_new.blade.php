<tr class="components-Table-TableRow___self___26NdW components-Table-TableRow___hoverable___G9APj">
    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A">
        {{$result->name}}
    </td>
    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A">
        {{$arUnitType[0]->name}}
    </td>
    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A">
        <div class="components-Inventory-components-Products-ProductList___number-column___1RtFJ">
            {{$result->quantity}}
        </div>
    </td>
    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A">
        <div class="components-Inventory-components-Products-ProductList___number-column___1RtFJ">
                                                                       <span>
                                                                           <span class="components-Inventory-components-Products-ProductPrice___full-price___1cwfp">
                                                                               {{$result->unit_price}}
                                                                           </span>
                                                                       </span>
        </div>
    </td>
    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A">
        <div class="components-Inventory-components-Products-ProductList___number-column___1RtFJ">
                                                                       <span class="components-Inventory-components-Products-ProductPrice___full-price___1cwfp">
                                                                   <button class="components-Button-Button___btn___2Akmm components-Button-Button___btn-collapse___3GpfG components-Button-Button___btn-success___3ZLjD components-Button-Button___medium___2jLbJ" data-link="/inventory/issue_invantary_form/{{$result->id}}" data-type="update">
                                                   <span class="components-Button-Button___children-collapse___1zj0X components-Button-Button___medium___2jLbJ">
                                                       Выдать инвентарь
                                                   </span>
                                                                       <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Button-Button___icon-collapse___3PKkW components-Button-Button___medium___2jLbJ"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill-rule="evenodd" d="M26 22V8c0-1.11-.895-2-2-2-1.112 0-2 .895-2 2v14H8c-1.11 0-2 .895-2 2 0 1.112.895 2 2 2h14v14c0 1.11.895 2 2 2 1.112 0 2-.895 2-2V26h14c1.11 0 2-.895 2-2 0-1.112-.895-2-2-2H26z"></path></svg></span>
                                                                   </button>
                                                                       </span>
        </div>
    </td>
</tr>