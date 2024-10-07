@extends ('layouts.layout_2')

@section('head')
    <title>Patient Notes &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        table {
            /* font-family: arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
        }

        .background-active {
            background: linear-gradient(90deg, #d9aa59, rgba(65, 86, 83, 8));
        }

        .btn5 {
            padding: 11px 16px 7px;
            border-radius: 10px;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            border-color: transparent;
            width: auto;
            background-color: #102335;
            color: white;
        }

        h1,
        .h1,
        h2,
        .h2,
        h3,
        .h3,
        h4,
        .h4,
        h5,
        .h5,
        h6,
        .h6 {

            margin-bottom: -0.5rem !important;

        }

        .fs-17 {
            color: white;
            font-size: 17px;
            margin-bottom: 0px !important;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <form method="post" action="{{ route('savePatientNotes') }}">



                {{-- <p class="template-p">Disclaimer: We are aware that the template has not been updated. It should be updated
                    within the next two weeks. Thank you for your understanding.</p> --}}

                <div class="card1" id="card-title-1" style="margin-bottom: 20px;">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Table:</p>
                    </div>
                    <div class="card-body1">
                        {{-- <table id="myTable">
                            <tr>
                                <th>Ref Pt</th>
                                <th>Patent</th>
                                <th>EWL </th>
                                <th>CWL</th>
                                <th>MAF</th>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Alfreds </h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm </p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Alfreds </h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm </p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Alfreds </h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm </p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Alfreds </h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm </p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Alfreds </h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm </p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" name="fname">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </table> --}}
                        <table id="myTable">
                            <tr>
                                <th>Ref Pt</th>
                                <th>Patent</th>
                                <th>EWL</th>
                                <th>CWL</th>
                                <th>MAF</th>
                            </tr>
                            <tr>
                                <td>
                                    <h3>incisal edge</h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13">No</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="ewl_1">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_1">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_mm_1">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_mm_1">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_k_1">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>mb mbc</h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 ">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="ewl_2">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_2">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_mm_2">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_mm_2">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_k_2">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>ml mlc</h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13 ">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">No</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="ewl_3">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_3">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_mm_3">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_mm_3">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_k_3">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>d dbc</h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13">No</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="ewl_4">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_4">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_mm_4">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_mm_4">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_k_4">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>p mpc</h3>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn5 anek-telugu mr-13 background-active">Yes</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn5 anek-telugu mr-13">No</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="ewl_5">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_5">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="fs-17">(K) at</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="cwl_mm_5">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_mm_5">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">mm</p>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="maf_k_5">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="fs-17">K</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>

                <div class="py-4">
                    <button type="button" onclick="generateJSON()">Generate JSON</button>

                    <div id="inputbox" style="display:none"></div>

                    <input type="hidden" name="patientNotesJson" id="savedJsonText" value="">
                    <button type="button" id="generateJsonText" class="btn2 anek-telugu mr-13">Save</button>

                    <input type="submit" id="submitPatientNotes" style="display:none;" class="copyTextBtn"
                        value="Save" />
                    <button type="button" onclick="copyContent()" class="btn3 anek-telugu">Copy text</button>

                </div>
            </form>
        </div>
    </div>



@section('customjs')
    <script>
        function generateJSON() {
            let table = document.getElementById('myTable');
            let rows = table.rows;
            let data = [];

            for (let i = 1; i < rows.length; i++) {
                let row = rows[i];
                let cwlValue = row.cells[3].querySelector('input[name="cwl_' + i + '"]').value;
                let cwlAt = row.cells[3].querySelector('input[name="cwl_mm_' + i + '"]').value;

                let mafValue = row.cells[4].querySelector('input[name="maf_mm_' + i + '"]').value;
                let mafK = row.cells[4].querySelector('input[name="maf_k_' + i + '"]').value;

                let cwlFormatted = cwlValue && cwlAt ? `${cwlValue} (K) at ${cwlAt} mm` : '_ (K) at _ mm';
                let mafFormatted = mafValue && mafK ? `${mafValue} mm ${mafK} K` : '_ mm _ K';

                let obj = {
                    "Ref Pt": row.cells[0].innerText.trim(),
                    "Patent": row.cells[1].querySelector('button.background-active').innerText,
                    "EWL": row.cells[2].querySelector('input[name="ewl_' + i + '"]').value || '_ mm',
                    "CWL": cwlFormatted,
                    "MAF": mafFormatted
                };

                data.push(obj);
            }

            console.log(JSON.stringify(data));
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.selectOption').on('click', function() {
                $(this).toggleClass('background-active');
                generateTextNow();
            });
        });


        // $(document).ready(function() {
        // Adding numeric to ID
        var output = document.querySelectorAll("#output");
        var img = document.querySelectorAll("#toggleButton");
        for (var i = 0; i < output.length; i++) {
            output[i].setAttribute("id", "output" + i);
            img[i].setAttribute("clickedId", "output" + i);
            img[i].setAttribute("id", "toggleButton" + i);
        }

        var voiceStatus = document.querySelectorAll("#status");
        for (var i = 0; i < voiceStatus.length; i++) {
            voiceStatus[i].setAttribute("id", "status" + i);
        }

        $('select').change(function() {
            generateTextNow();
        });
        $('input').change(function() {
            generateTextNow();
        });

        // function recordNow(event) {
        //     if (!isListening) {
        //         var clickedId = $(event.target).attr('clickedId');
        //         startRecording(clickedId);
        //     } else {
        //         stopRecording();
        //     }
        // }

        function recordNow(event) {
            var image = event.target;
            var currentSrc = image.src;

            var firstImage = '{{ asset('images/open-mic.png') }}';
            var secondImage = '{{ asset('images/shop/mic.png') }}';

            isListening = !isListening;

            image.src = isListening ? secondImage : firstImage;

            if (isListening) {
                var clickedId = $(event.target).attr('clickedId');
                startRecording(clickedId);
            } else {
                stopRecording();
            }
        }

        //    recordNow = () => {
        //       alert($(this).attr('clickedid'));
        //        if (!isListening) {
        //         startRecording();
        //     } else {
        //         stopRecording();
        //     }

        //   }


        // ---------------------------------------------------

        // var isListening = false;
        // var recognition = null;
        // runSpeechRecog = (clickedId) => {
        //     var originalText = $("#"+clickedId).val();

        //     if(originalText != ''){
        //         final_transcript = originalText + ' ';
        //     }
        //     if (!isListening) {
        //     startRecording();
        // } else {
        //     stopRecording();
        // }

        // };

        var isListening = false;
        var recognition = null;
        var toggleButton = document.getElementById("toggleButton0");

        var transcriptionDiv = document.getElementById("transcription");

        /* toggleButton.addEventListener("click", function () {
                var clickedId = $(this).attr('clickedId');
                alert(clickedId);
            if (!isListening) {
                startRecording();
            } else {
                stopRecording();
            }
        });*/

        function startRecording(clickedId) {
            try {
                recognition = new webkitSpeechRecognition();
                recognition.continuous = true;

                recognition.onstart = function(event) {
                    toggleButton.textContent = "Stop Speech Recognition";
                    statusDiv.textContent = "Speech recognition in progress...";
                };

                recognition.onresult = function(event) {
                    var transcription = "";
                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        transcription += event.results[i][0].transcript;
                    }
                    transcriptionDiv.innerHTML =
                        transcriptionDiv.innerHTML + " " + transcription;
                    $('#' + clickedId).attr('value', $('#' + clickedId).val() + " " + transcription)
                };

                recognition.onerror = function(event) {
                    console.error(
                        "An error occurred during speech recognition: ",
                        event.error
                    );
                    statusDiv.textContent = "Error: Speech recognition encountered an error.";
                    stopRecording();
                };

                recognition.onnomatch = function(event) {
                    console.error("No speech recognized: ", event);
                    statusDiv.textContent =
                        "Error: No speech recognized. Please check your microphone permissions.";
                };

                recognition.onend = function() {
                    toggleButton.textContent = "Start Speech Recognition";
                    statusDiv.textContent = "Speech recognition stopped.";
                    isListening = false;
                };

                recognition.start();
                isListening = true;
            } catch (error) {
                console.error(
                    "An error occurred while starting speech recognition: ",
                    error
                );
                statusDiv.textContent = "Error: Speech recognition could not be started.";
            }
        }

        function stopRecording() {
            console.log(isListening + "hhh");
            if (recognition) {
                console.log(isListening);
                recognition.stop();
                recognition = null;
            }
            toggleButton.textContent = "Start Speech Recognition";
            // statusDiv.textContent = "";
            isListening = false;
        }


        // --------------------------------------------------
        // Audio Record
        // });

        generateTextNow();

        // function generateTextNow() {
        //     var generateText = '';

        //     $(".card1").each(function() {
        //         var title = $(this).find(".speech_to_1").text().trim();
        //         generateText += title + "\n";

        //         $(this).find("li").each(function() {
        //             var heading = $(this).find(".please_acc").text().trim();
        //             generateText += heading + ': ';

        //             var selectedValues = [];
        //             $(this).find(".background-active").each(function() {
        //                 selectedValues.push($(this).val());
        //             });

        //             if (selectedValues.length > 0) {
        //                 generateText += selectedValues.join(', ') + "\n";
        //             } else {
        //                 generateText += '-\n';
        //             }
        //         });

        //         generateText += '\n';
        //     });

        //     $('#inputbox').text(generateText);
        // }


        function generateTextNow() {
            var generateText = '';

            $("input[type='text'],input[type='hidden'],select,button.background-active").each(function() {

                if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
                    $titleId = $(this).attr("uniqName");

                    if ($(this).attr("uniqName")) {
                        generateText += $(this).attr("title") + "\n";
                    }

                } else {
                    if ($(this).attr("uniqName")) {
                        if ($(this).val() == '' || $(this).val() == 'InputText') {
                            if ($(this).attr('typeVal') == 'speechToText') {} else {
                                generateText += $(this).attr("question") + '-' + "\n";
                            }
                        } else {
                            generateText += $(this).attr("question") + ': ' + $(this).val() + "\n";
                        }
                    }
                }

                if ($(this).attr('typeVal') == 'speechToText') {
                    generateText += '\n';
                }

            });
            // alert(generateText);

            $('#inputbox').text(generateText);
        }

        $('#generateJsonText').click(function() {
            generateJsonText();
        });

        // function generateJsonText() {
        //     var generateJsonText = [];
        //     var titles = {};

        //     $("input[type='text'], input[type='hidden'], select, button.background-active").each(function() {
        //         var title = $(this).attr('title');

        //         if (title && $(this).attr("type") == 'hidden') {
        //             var titleId = $(this).attr("uniqName");
        //             titles[titleId] = title;
        //             var titleData = {
        //                 "title": title,
        //                 "headings": []
        //             };
        //             generateJsonText.push(titleData);
        //         } else {

        //             if ($("input[type='text'") && $(this).attr('question') == 'Speech to text') {
        //                 $speechToTextHeading = 'Speech to text';
        //                 $speechToTextValue = $(this).val();
        //             } else {
        //                 $heading = {};
        //                 $ques = $(this).attr('question');
        //                 $content = $(this).attr('content');
        //                 $val = $(this).val();
        //                 $speechToTextHeading = '-';
        //                 $speechToTextValue = '-';
        //             }
        //             $length = generateJsonText.length;

        //             var uniqName = $(this).attr("uniqName");
        //             var stringSplit = uniqName ? uniqName.split('-') : [];

        //             if (stringSplit.length >= 2) {
        //                 var titleId = stringSplit[0];
        //                 var headingId = stringSplit[1];
        //                 var ques = $(this).attr('question');
        //                 var content = $(this).attr('content');
        //                 var val = $(this).val();
        //                 var speechToTextHeading = '-';
        //                 var speechToTextValue = '-';

        // if ($(this).is("button.background-active")) {
        //     var heading = titles[titleId];
        //     if (!generateJsonText.find(item => item.title === heading)) {
        //         generateJsonText.push({
        //             "title": heading,
        //             "headings": []
        //         });
        //     }
        //     var headingData = generateJsonText.find(item => item.title === heading).headings.find(
        //         item => item.heading === ques);
        //     if (!headingData) {
        //         headingData = {
        //             "heading": ques,
        //             "content": content,
        //             "values": []
        //         };
        //         generateJsonText.find(item => item.title === heading).headings.push(headingData);
        //     }
        //     headingData.values.push(val);
        // }

        //                 if ($(this).attr('typeVal') == 'speechToText') {
        //                     speechToTextHeading = 'Speech to text';
        //                     speechToTextValue = val;
        //                 }

        //                 if (stringSplit.length > 2) {
        //                     var subHeading = ques;
        //                     if (!headingData.subHeadings) {
        //                         headingData.subHeadings = [];
        //                     }
        //                     var subHeadingData = {
        //                         "subHeading": subHeading,
        //                         "content": content,
        //                         "value": val,
        //                         "speechToTextHeading": speechToTextHeading,
        //                         "speechToTextValue": speechToTextValue
        //                     };
        //                     headingData.subHeadings.push(subHeadingData);
        //                 }
        //                 // else {
        //                 //     var heading = ques;
        //                 //     var headingData = {
        //                 //         "heading": heading,
        //                 //         "content": content,
        //                 //         "value": val,
        //                 //         "speechToTextHeading": speechToTextHeading,
        //                 //         "speechToTextValue": speechToTextValue,
        //                 //         "subHeadings": []
        //                 //     };
        //                 //     if (!generateJsonText.find(item => item.title === titles[titleId]).headings) {
        //                 //         generateJsonText.find(item => item.title === titles[titleId]).headings = [];
        //                 //     }
        //                 //     generateJsonText.find(item => item.title === titles[titleId]).headings.push(headingData);
        //                 // }
        //             }
        //         }
        //     });

        //     console.log(generateJsonText);

        //     event.preventDefault();

        //     //$('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
        //     //$("#submitPatientNotes").click();
        // }

        function generateJsonText() {
            var generateJsonText = [];
            $section1 = 0;
            $section2 = 0;

            $("input[type='text'],input[type='hidden'],button.background-active").each(function() {

                if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
                    $titleId = $(this).attr("uniqName");
                    var title = {};

                    title = {
                        "title": $(this).attr('title'),
                        "headings": []
                    };

                    generateJsonText.push(title);
                } else {

                    if ($("input[type='text'") || $("select")) {

                        if ($("input[type='text'") && $(this).attr('question') == 'Speech to text') {
                            $speechToTextHeading = 'Speech to text';
                            $speechToTextValue = $(this).val();
                        } else {
                            $heading = {};
                            $ques = $(this).attr('question');
                            $content = $(this).attr('content');
                            $val = $(this).val();
                            $speechToTextHeading = '-';
                            $speechToTextValue = '-';
                        }
                        $length = generateJsonText.length;

                        if ($(this).attr("uniqName")) {
                            $uniqName = $(this).attr("uniqName");
                            $stringSplit = $uniqName.split('-');

                            $headingIdAlone = $stringSplit[1];

                            //Checking if its subheading
                            if ($stringSplit.length > 2) {

                                if ($stringSplit[0] == $titleId && $stringSplit[1] == $headingIdAlone && $(this)
                                    .attr('question') != 'Speech to text') {
                                    $heading = {
                                        "heading": $(this).attr('subHeadQuestion'),
                                        "subHeadings": [],
                                    };
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    generateJsonText[$length - 1].headings.push($heading);

                                    $subHeading = {
                                        "subHeading": $ques,
                                        "content": $content,
                                        "value": $val,
                                        "speechToTextHeading": $speechToTextHeading,
                                        "speechToTextValue": $speechToTextValue
                                    }
                                    console.log($headingLength);
                                    console.log(generateJsonText[$length - 1].headings[$headingLength].subHeadings);

                                    generateJsonText[$length - 1].headings[$headingLength].subHeadings.push(
                                        $subHeading);

                                } else {

                                    $headingLength = generateJsonText[$length - 1].headings.length;

                                    console.log(generateJsonText[$length - 1].headings);

                                    $subHeadingLength = generateJsonText[$length - 1].headings[$headingLength - 1]
                                        .subHeadings.length;

                                    generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
                                        $subHeadingLength - 1].speechToTextHeading = 'Speech to text';
                                    generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
                                        $subHeadingLength - 1].speechToTextValue = $(this).val();
                                }

                            } else {
                                //Just headings
                                $heading = {
                                    "heading": $ques,
                                    "content": $content,
                                    "value": $val,
                                    "speechToTextHeading": $speechToTextHeading,
                                    "speechToTextValue": $speechToTextValue
                                };

                                // Check its not speech to text
                                if ($stringSplit[0] == $titleId && $(this).attr('question') != 'Speech to text') {
                                    generateJsonText[$length - 1].headings.push($heading);
                                    console.log(generateJsonText);
                                } else {
                                    // If its Speech to text
                                    // $heading = {
                                    // "heading" : $prevQues,
                                    // "content" : $prevContent,
                                    // "value" : $preVal,
                                    // "speechToTextHeading" : 'Speech to text',
                                    // "speechToTextValue" : $(this).val()
                                    // };
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    console.log(generateJsonText[$length - 1].headings[$headingLength - 1]
                                        .speechToTextHeading);

                                    generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextHeading =
                                        'Speech to text';
                                    generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextValue =
                                        $(this).val();
                                }
                            }
                        }

                        if ($("input[type='text'") && $(this).attr('question') != 'Speech to text') {
                            $prevUniqName = $(this).attr("uniqName");
                            $prevQues = $ques;
                            $prevContent = $content;
                            $preVal = $val;
                        }

                    }
                }

            });
            console.log(generateJsonText);
            $('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
            $("#submitPatientNotes").click();
        }

        function copyContent() {
            var copyText = $("#inputbox").text();
            navigator.clipboard.writeText(copyText);
            // alert("Text copied successfully");
            console.log("COPY :", copyText)
            // alert("Copied the text: " + copyText);
        }
    </script>
