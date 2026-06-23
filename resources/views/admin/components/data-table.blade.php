<div class="saas-card">
    @if(isset($header))
    <div class="card-header">
        <h6>{{ $header }}</h6>
        @if(isset($headerActions))
            <div class="d-flex gap-2">{{ $headerActions }}</div>
        @endif
    </div>
    @endif
    <div class="card-body p-0">
        <div class="saas-table-wrapper" style="border: none; box-shadow: none; border-radius: 0;">
            <table class="saas-table mb-0" id="{{ $id ?? 'dataTable' }}" {{ $attributes ?? '' }}>
                <thead>
                    <tr>
                        {{ $headers }}
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
    @if(isset($footer))
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        @if(isset($id))
        if ($.fn.DataTable) {
            $('#{{ $id }}').DataTable({
                ordering: true,
                searching: true,
                pageLength: {{ $pageLength ?? 25 }},
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                dom: '<"saas-table-toolbar"f>t<"d-flex justify-content-between align-items-center mt-3"ip>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass('saas-form-control').attr('placeholder', 'Search...');
                    $('.dataTables_length select').addClass('saas-form-select saas-form-control-sm');
                }
            });
        }
        @endif
    });
</script>
@endpush
