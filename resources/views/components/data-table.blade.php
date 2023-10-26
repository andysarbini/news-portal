<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example" >
        @isset($thead)    
            <thead>
                {{ $thead }}
            </thead>
        @endisset

        @isset($tbody)           
            <tbody>
                {{ $tbody }}
            </tbody>
        @endisset

        @isset($tfoot)            
            <tfoot>
                {{ $tfoot }}
            </tfoot>
        @endisset
    </table>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]
            });          
        });
    </script>
 @endpush