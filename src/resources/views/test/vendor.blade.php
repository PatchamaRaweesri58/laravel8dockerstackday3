@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: left;
            margin-right: 10px;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }
    </style>
@endsection

@section('content')
    <!-- ตารางแสดงข้อมูล -->
    <table id="myTable" class="display" style="width:100%">

        <a href="http://localhost:8100/api/data">
            <h3>API backend</h3>
        </a>
        <div>
            <label for="vendor">Select Vendor:</label>
            <select id="vendor" name="vendor" onchange="showSelectionInfo()">
                <option value="">Choose Vendor</option>
                <!-- Options will be dynamically inserted here -->
            </select>
            <div id="selected-info"></div>
        </div>
        <thead>
            <tr>
                <th>ID</th>
                <th>mac_prefix</th>
                <th>vendor</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($test as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->mac_prefix }}</td>
                    <td>{{ $item->vendor }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        {{ $test->links() }}
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#myTable').DataTable({
                lengthChange: false, // เพิ่มคุณสมบัติเพื่อปิดการแสดงตัวเลือก "Entries"
                pageLength: 100 // กำหนดจำนวนหน้าที่แสดงต่อหน้าเริ่มต้นเป็น 100
            });


            // เปลี่ยนปุ่ม Search เป็น ค้นหา
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'ค้นหา mac_prefix');

            // เพิ่มการค้นหาในคอลัมน์ mac_perfix
            $('#myTable_filter input[type="search"]').on('keyup', function() {
                var searchValue = $(this).val();
                $('#myTable').DataTable().column(1).search(searchValue).draw();
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            axios.get('/search-vendors')
                .then(function(response) {
                    var select = document.getElementById('vendor');
                    response.data.forEach(function(vendor) {
                        var option = document.createElement('option');
                        option.text = vendor;
                        option.value = vendor;
                        select.appendChild(option);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching top vendors:', error);
                });
        });
  
function showSelectionInfo() {
    var select = document.getElementById('vendor');
    var selectedOption = select.options[select.selectedIndex];
    var selectedName = selectedOption.text;
    var selectedValue = selectedOption.value;

    // นับจำนวนข้อมูลที่มีชื่อเหมือนกัน
    var count = data.reduce((acc, curr) => {
    return curr.name === selectedName ? acc + 1 : acc;
}, 0);

    // แสดงข้อมูลที่เลือกและจำนวนข้อมูลที่มีชื่อเหมือนกัน
    document.getElementById('selected-info').innerHTML = 'Selected Vendor: ' + selectedName + '<br>' +
                                                          'Number of similar names: ' + count;
}

    </script>
@endsection
