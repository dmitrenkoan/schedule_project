<tr class="clickable-row employee" data-employee="172085" data-href="/employees/{{$obStaff->id}}/edit" data-id="{{$obStaff->id}}" data-remote="true" id="employee_{{$obStaff->id}}">
    <td class="icon-reorder ui-sortable-handle" style="width: 70px;"></td>
    <td class="p-l-none" style="width: 282px;">
        {{$obStaff->name}}
    </td>
    <td style="width: 308px;">
        {{$obStaff->phone}}
    </td>
    <td style="width: 308px;">
    <span class="components-Inventory-components-Products-ProductPrice___full-price___1cwfp">
        <a href="/employees/inventory/show/{{$obStaff->id}}">Просмотреть инвентарь</a>
    </span>
    </td>
</tr>