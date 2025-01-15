<div class="mb-2" style="text-align: center;">
    <form id="json-upload-form" enctype="multipart/form-data" method="POST" class="form1">
        <label for="json-file">Add a JSON file:&nbsp;</label>
        <input type="file" id="json-file" name="json-file" accept=".json">
        <button type="button" class="btn btn-success" id="upload-button">Import File</button>
    </form>
</div>
<div>
    <form class="form2">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" id="employee_name">

        <label for="event_name">Event Name:</label>
        <input type="text" name="event_name" id="event_name">

        <label for="event_date">Event Date:</label>
        <input type="date" name="event_date" id="event_date">

        <button type="button" class="btn btn-danger mt-3" id="reset-button">Reset</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Participation ID</th>
            <th>Employee Name</th>
            <th>Email</th>
            <th>Event Name</th>
            <th>Participation Fee</th>
            <th>Event Date</th>

        </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
            <td colspan="2" id="total-fee"><strong>0.00 €</strong></td>
        </tr>
    </tfoot>
</table>