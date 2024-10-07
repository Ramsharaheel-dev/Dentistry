@extends ('layouts.layout')

@section('head')
<title>Patient Notes &#8211; Dian</title>

<style>
    body {
        font-family: Arial;
        background: #000;
    }
    .template-container{
        margin:10px;
        width:100%;
    }
    .templateTitle{
        color:White;
        font-size:23px;
        font-weight:600;
    }
    .templateHeading{
        color:#d2d2d2;
        font-size:20px;
        font-weight:500;
    }
    .content{
        color:white;
    }
    .templateSubHeadingTitle{
        color:#d2d2d2;
        font-size:14px;
    }
    .templateFormSelect{
        background-color: #646464;
        color: #d2d2d2;
        height: 3.25em;
        border:none;
        font-size:14px;
    }
    .templateFormInput{
        background-color: #646464;
        color: #d2d2d2;
        border: none;
        font-size: 14px;
        border-radius: 5px;
        height: 3.25em;
        padding: 5px 22.5px 5px 10px;
        font-style: italic;
        width: -webkit-fill-available;
    }
    .copyTextBtn{
        font-family: "Roboto", Sans-serif !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        letter-spacing: 1px !important;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.3) !important;
        background-color: var(--e-global-color-9caa857 ) !important;
        border-radius: 7px 7px 7px 7px !important;
        padding: 10px 15px 10px 15px !important;
        color: white;
    }

    .chosen-container-multi .chosen-choices{
        background: #646464 !important;
        color: #d2d2d2 !important;
        height: 3.25em !important;
        border: none !important;
        font-size: 14px;
        border-radius: 5px !important;
        padding-top: 9px !important;
    }
    .chosen-container-multi .chosen-choices li.search-choice{
        background: #949494 !important;
        border: none !important;
        color: white !important;
    }

    .recorder{
        margin-top:6px;
        cursor:pointer;
        width:30px;
        height:30px;
    }
    
    ::placeholder { 
    color: #8c8c8c;
    }
    select.templateFormSelect option:hover {
    box-shadow: 0 0 10px 100px #D9AA5A;
}
</style>
@endsection

@section('content')

@include('requires.header')


<div class="template-container">

    <?php $count = 0; ?>
    <form method="post" action="{{ route('savePatientNotes') }}">
        @csrf
    <input type="hidden" name="templateId" value="{{ $templateId}}">
    <input type="hidden" name="templateName" value="{{ $templateName}}">
    <input type="hidden" name="data" value="testing data"/>
    @foreach($data as $titleContent)
   
    <p class="templateTitle">{{ $titleContent['title'] }}</p>
    <input question="{{ $titleContent['title'] }}" type="hidden">
    <?php if (array_key_exists("headings",$titleContent)) {?>

    @foreach($titleContent['headings'] as $headingTitle)
    <?php if (isset($headingTitle['heading'])) { ?>
        <p class="templateHeading">{{ $headingTitle['heading'] }}</p>
    <?php }?>

    <?php if (isset($headingTitle['content'])) { ?>
        <?php if($headingTitle['content'] == 'InputText'){ ?>
            <div class="row">
                <div class="col-lg-5">

                @if($headingTitle['heading'] == 'Comments:')
                
                <input title="{{ $titleContent['title'] }}" question="{{ $headingTitle['heading'] }}" value="InputText" typeVal = "InputText" class="templateFormInput" id="myData" type="text" name="" placeholder="Insert Comments">

                @else
                <input title="{{ $titleContent['title'] }}" question="{{ $headingTitle['heading'] }}" value="InputText" typeVal = "InputText" class="templateFormInput" id="myData" type="text" name="" placeholder="Insert Comments">
                @endif
                
                </div>
                <div class="col-lg-1">
                <img class="recorder" id="recorderImg" onclick="runSpeechRecog($(this).attr('clickedid'))" src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png"/> 
                </div>
                <div class="col-lg-6">
                <?php $count = $count + 1; ?>
                <input title="{{ $titleContent['title'] }}" question="Speech to text"  typeVal = "speechToText" class="templateFormInput" id='output' type="text" name="" placeholder="Speech to Text">
                  
            </div>
            </div>
            
            <?php echo "<br/>";?>
        <?php } else { ?>
            <div class="row">
                <div class="col-lg-5">
                <select title="{{ $titleContent['title'] }}" multiple question="{{ isset($headingTitle['heading']) ? $headingTitle['heading'] : '' }}" class="chosen-select templateFormSelect form-select form-select-lg mb-3" id="myData" aria-label=".form-select-lg example">
                
                @foreach((array)($headingTitle['content']) as $content)
                <option value="{{ $content }}">{{ $content }}</option>
                @endforeach
                </select>
                </div>
                <div class="col-lg-1">
                <img class="recorder" id="recorderImg"  onclick="runSpeechRecog($(this).attr('clickedid'))"  src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png"/> 
                </div>
                <div class="col-lg-6">
                <?php $count = $count + 1; ?>
                <input title="{{ $titleContent['title'] }}" question="Speech to text"  typeVal = "speechToText" class="templateFormInput speechToText" id='output' type="text" name="" placeholder="Speech to Text">
                </div>
            </div>
        
        <?php } ?>
        <?php echo "<br/>";?>
    <?php }?>

    <?php if (isset($headingTitle['subHeadings'])) { ?>
        @foreach($headingTitle['subHeadings'] as $subHeading)
        <p class="templateSubHeadingTitle">{{ $subHeading['subHeading'] }}</p>
        
        <div class="row">
            <div class="col-lg-5">
            <select title="{{ $titleContent['title'] }}" multiple question="{{ isset($headingTitle['subHeadings']) ? $subHeading['subHeading'] : '' }}" class="chosen-select templateFormSelect form-select form-select-lg mb-3" id="myData" aria-label=".form-select-lg example">
        
                @foreach($subHeading['content'] as $content)
                <option value="{{ $content }}">{{ $content }}</option>
                @endforeach
            </select>
            </div>

            <div class="col-lg-1">
            <img class="recorder" id="recorderImg" onclick="runSpeechRecog($(this).attr('clickedid'))" src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png" /> 
            </div>

            <div class="col-lg-6">
            <?php $count = $count + 1; ?>
            <input title="{{ $titleContent['title'] }}" question="Speech to text" typeVal = "speechToText" class="templateFormInput speechToText" id="output" type="text" name="" placeholder="Speech to Text">
            </div>
        </div>
       @endforeach
    <?php }?>

    @endforeach
    <?php } ?>
    <?php echo "<br/>"; ?>

    @endforeach

    <div id="inputbox" style="display:none"></div>

    <button onclick="copyContent()" class="copyTextBtn">Copy text</button>
    <input type="submit" class="copyTextBtn" value="Save"/>
    </form>
</div>
@endsection
@section('customjs')
<script>
   
    $(document).ready(function() {
        // Adding numeric to ID
        var output = document.querySelectorAll ("#output");
        var img = document.querySelectorAll("#recorderImg");
        for (var i = 0; i < output.length;  i++) {
            output[i].setAttribute("id", "output"+i);
            img[i].setAttribute("clickedId","output"+i);
        }

       

        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
        $('select').change(function() {
            generateTextNow();
        });
        $('input').change(function() {
            generateTextNow();
        });

        
        // --------------------------------------------------
        // Audio Record

        runSpeechRecog = (clickedId) => {
            var output = document.getElementById(clickedId);
            let recognization = new webkitSpeechRecognition();
            recognization.onstart = () => {
            }
            recognization.onresult = (e) => {
               var transcript = e.results[0][0].transcript;
               $("#"+clickedId).attr('value', transcript)
               console.log(transcript);
            }
            recognization.start();
         }
    });

    generateTextNow();

    function generateTextNow() {
        var generateText = '';
        $("input[type='text'],input[type='hidden'],select").each(function() {
            if($(this).val() == '' || $(this).val() == 'InputText'){

                    if($(this).attr("type") == 'hidden'){
                        generateText += $(this).attr("question")  + "\n";
                    }else if( $("input[type='text'") || $("select") ){
                        generateText += $(this).attr("question") + ' -' + "\n";
                    }

            }else{

                    if($(this).attr("type") == 'hidden'){
                        generateText += $(this).attr("question")  + "\n";
                    }else {
                        generateText += $(this).attr("question") + $(this).val() + "\n";
                    }

                    // console.log(generateText);

            }
            if($(this).attr('typeVal')=='speechToText'){
                generateText += '\n';
            }
        });
        // alert(generateText);
        $('#inputbox').text(generateText);
    }
    
    function copyContent() {
        var copyText = $("#inputbox").text();
        navigator.clipboard.writeText(copyText);
        // console.log("COPY :", copyText)
        // alert("Copied the text: " + copyText);
    }
</script>

@endsection