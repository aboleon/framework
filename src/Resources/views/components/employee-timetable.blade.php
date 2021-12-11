<table class="table working_periods table-bordered timetables">
    <thead>
    <tr>
        <th class="days" colspan="2">
            @foreach (App\Models\OpeningTime::days() as $day => $label)
                <x-bootstrap-checkbox class="form-check-inline period_days"
                                      for-label="working_time[]{{$day}}"
                                      :label="$label"
                                      :id="$day"
                                      name="working_time[][days]"
                                      :affected="collect()"/>
            @endforeach

            <span class="iteration">{{ $iteration }}</span>
        </th>
        <th width="52">
            <a href="#" class="btn btn-danger btn-sm remove_working_period">
                <i class="fa fa-trash"></i>
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="p-0" colspan="2">
            <div class="hours_container">
                <div class="row hours_line">
                    <div class="slot col-xl-4">
                        <input type="text" name="working_time[][hour_starts][]" class='datepicker form-control hour_starts' data-enable-time="true" data-date-format="H:i" data-config="noCalendar=true" value="09:00"/>

                        <input type="text" name="working_time[][hour_ends][]" class='datepicker form-control hour_ends' data-enable-time="true" data-date-format="H:i" data-config="noCalendar=true" value="17:00">
                        <a href="#" class="btn btn-success btn-sm add_hours">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
    <thead>
    <tr>
        <th colspan="2" style="padding: 10px 8px !important;">
            {{ trans_choice('aboleon.framework::ui.pause',2) }}
        </th>
    </tr>
    <tr>
        <td class="p-0" colspan="2">
            <div class="hours_container">
                <div class="row hours_line">
                    <div class="slot col-xl-4">
                        <input type="text" name="working_time[][pause_starts][]" class='datepicker form-control hour_starts' data-enable-time="true" data-date-format="H:i" data-config="noCalendar=true" value="12:00"/>

                        <input type="text" name="working_time[][pause_ends][]" class='datepicker form-control hour_ends' data-enable-time="true" data-date-format="H:i" data-config="noCalendar=true" value="14:00">
                        <a href="#" class="btn btn-success btn-sm add_hours">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    </thead>
</table>
