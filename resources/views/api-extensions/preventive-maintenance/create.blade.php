<h5 class="mb-3">Preventive Maintenance</h5>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $preventiveMaintenance::getPrefixInputId('Period') ?>

            <label for="{{ $prefix_id }}" class="form-label">Period</label>
            <select name="{{  $preventiveMaintenance::getPrefixInputName('period') }}" id="{{ $prefix_id }}" class="form-select">
                <option value="day">Day</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $preventiveMaintenance::getPrefixInputId('Until') ?>

            <label for="{{ $prefix_id }}" class="form-label">Until</label>
            <input type="date" class="form-control" name="{{  $preventiveMaintenance::getPrefixInputName('until') }}">
        </div>
    </div>
</div>
