var trainingList = [
    { Designation: 'Appearance', Training: 'Basic Skills Competency' },
    { Designation: 'Appearance', Training: 'Basic Medication Management Concepts' },
    { Designation: 'Appearance', Training: 'Basic Infusion Therapy' },
    { Designation: 'Appearance', Training: 'Holistic Wellness Development Program' },
    { Designation: 'Appearance', Training: 'Quality and Patient Safety Training' },
    { Designation: 'Appearance', Training: 'Palliative Training' },
    { Designation: 'Appearance', Training: 'Cardiac Telemetry' },
    { Designation: 'Appearance', Training: 'Geriatric Nursing' },
    { Designation: 'Appearance', Training: 'Charge Nurse Training' },
    { Designation: 'Appearance', Training: 'Clinical Preceptorship Training' },
    { Designation: 'Appearance', Training: 'Critical Care Course' },
    { Designation: 'Appearance', Training: 'Perioperative Safety' },
    { Designation: 'Appearance', Training: 'Perioperative Care in CV Surgery' },
    { Designation: 'Appearance', Training: 'Emergency Room Training' },
    { Designation: 'Appearance', Training: 'Cardiovascular Laboratory Training' },
    { Designation: 'Appearance', Training: 'Basic ICU Skills Competency' },
    { Designation: 'Appearance', Training: 'Continuous Renal Replacement Therapy Training' },
    { Designation: 'Appearance', Training: 'Cardiovascular Nurse Practitioner Training Program' },
    { Designation: 'Appearance', Training: 'Nursing Management Development Course' },
    { Designation: 'Appearance', Training: 'Nurse Educator Training' },
    { Designation: 'Appearance', Training: 'Assessors Training' },
    { Designation: 'Appearance', Training: 'Ward Clerk Training I' },
    { Designation: 'Appearance', Training: 'Ward Clerk Trainig II' },
    { Designation: 'Appearance', Training: 'Ward Clerk Training III' },
    { Designation: 'Appearance', Training: 'Nursing Attendant Training I' },
    { Designation: 'Appearance', Training: 'Nursing Attendant Training II' },
    { Designation: 'Appearance', Training: 'Nursing Attendant Training III' },
    { Designation: 'Others', Training: 'Others' }
];

$(document).ready(function () {
$(".others").hide();
    $('#certDesignation').change(function () {
        $('#trainingCert').html('<option value="" selected hidden>Training</option>');
            const certs = trainingList.filter(m => m.Designation == $('#certDesignation').val() || m.Training == "Others");
            certs.forEach(element => 
            {
            const option = "<option val='" + element.Training + "'>" + element.Training + "</option>";
            $('#trainingCert').append(option);  
            })
        });

    $("#trainingCert").change(function () {
    // debugger;
    if ($("#trainingCert").val() == "Others") {
        $(".others").show();
    }  
    else {
        $(".others").hide();
    }
    });
});

$(document).ready(function () {  
    $('#addReq').click(function(){
    var length = $('.req').length;
    var i   = parseInt(length)+parseInt(1);
    var newrow = $('#next').append(
        '<div class="row">'+
            '<input type="text" class="form-control req" name="reqno[]" id="reqno" value="'+i+'" readonly="" hidden>'+
            '<div class="input-box">'+
                '<label for="DateofBirth">Date:</label>'+
                '<input type="date" id="trainingDate'+i+'" name="trainingDate[]" class="form-control"/>'+
            '</div>'+
            '<div class="input-box">'+
            '<label for="trainingDateTo">Date To:</label>'+
            '<input type="date" id="trainingDateTo" name="trainingDateTo[]" class="form-control" required/>'+
            '</div>'+
            '<div class="input-box">'+
                '<label for="Document Requesting">Document Requesting:</label>'+
                '<select class="select-box" required name="certDesignation[]" class="certDesignation" id="certDesignation'+i+'">'+
                '<option hidden selected>Document Requesting:</option>'+
                '<option value="Appearance">Certificate of Appearance</option>'+
                '</select>'+
            '</div>'+
            '<div class="input-box">'+
                '<label for="Title">Title:</label>'+
                '<select class="select-box" name="trainingCert[]" id="trainingCert'+i+'">'+
                    '<option selected hidden>Title:</option>'+
                '</select>'+
            '</div>'+
            '<div class="others'+i+' input-box">'+
                '<label for="Others">Others:</label>'+
                '<input name="otherTrainingCert[]" id="otherTrainingCert'+i+'" type="text" placeholder="Input Title"/>'+
            '</div>'+
            '<button type="button" class="btnRemove">Remove</button>'+
        '</div>'
        );
        

        $('#certDesignation'+i).change(function () {
        $('#trainingCert'+i).html("<option hidden selected>Training</option>");
            const certs = trainingList.filter(m => m.Designation == $('#certDesignation'+i).val() || m.Training == "Others");
            certs.forEach(element => 
            {
            const option = "<option val='" + element.Training + "'>" + element.Training + "</option>";
            $('#trainingCert'+i).append(option);  
            })
        });

        $(".others"+i).hide();
        $("#trainingCert"+i).change(function () {
            // debugger;
            if ($("#trainingCert"+i).val() == "Others") {
                $(".others"+i).show();
            } 
            else {
                $(".others"+i).hide();
            }
        });
    });
    
});

$('body').on('click','.btnRemove',function() {
    $(this).closest('div').remove()
});