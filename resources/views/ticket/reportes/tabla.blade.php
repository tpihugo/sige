<div class="table-responsive" id="table_reportes">
    <table class="table">
        @foreach ($ticket as $key => $value)
            <tr>
                <td class="text-dark fw-bold">
                    {{ $key }}
                </td>
                @php
                    $departamentos = $value->groupBy('departamento');
                @endphp
                <td>
                    <h6 class="text-end">Total: {{ count($value) }}</h6>
                    <table class="table table-bordered">
                        @foreach ($departamentos as $elements => $element)
                            <tr>
                                <td>
                                    {{ $elements }}
                                </td>
                                <td>
                                    {{ count($element) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
    </table>
</div>