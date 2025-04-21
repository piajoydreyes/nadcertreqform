var trainingList = [
    { Designation: 'Nurses', Training: 'Basic Skills Competency' },
    { Designation: 'Nurses', Training: 'Basic Medication Management Concepts' },
    { Designation: 'Nurses', Training: 'Basic Infusion Therapy' },
    { Designation: 'Nurses', Training: 'Holistic Wellness Development Program' },
    { Designation: 'Nurses', Training: 'Quality and Patient Safety Training' },
    { Designation: 'Nurses', Training: 'Palliative Training' },
    { Designation: 'Nurses', Training: 'Cardiac Telemetry' },
    { Designation: 'Nurses', Training: 'Geriatric Nursing' },
    { Designation: 'Nurses', Training: 'Charge Nurse Training' },
    { Designation: 'Nurses', Training: 'Clinical Preceptorship Training' },
    { Designation: 'Nurses', Training: 'Critical Care Course' },
    { Designation: 'Nurses', Training: 'Perioperative Safety' },
    { Designation: 'Nurses', Training: 'Perioperative Care in CV Surgery' },
    { Designation: 'Nurses', Training: 'Emergency Room Training' },
    { Designation: 'Nurses', Training: 'Cardiovascular Laboratory Training' },
    { Designation: 'Nurses', Training: 'Basic ICU Skills Competency' },
    { Designation: 'Nurses', Training: 'Continuous Renal Replacement Therapy Training' },
    { Designation: 'Nurses', Training: 'Cardiovascular Nurse Practitioner Training Program' },
    { Designation: 'Nurses', Training: 'Nursing Management Development Course' },
    { Designation: 'Nurses', Training: 'Nurse Educator Training' },
    { Designation: 'Nurses', Training: 'Assessors Training' },
    { Designation: 'Ward Clerks', Training: 'Ward Clerk Training I' },
    { Designation: 'Ward Clerks', Training: 'Ward Clerk Trainig II' },
    { Designation: 'Ward Clerks', Training: 'Ward Clerk Training III' },
    { Designation: 'Nursing Attendants', Training: 'Nursing Attendant Training I' },
    { Designation: 'Nursing Attendants', Training: 'Nursing Attendant Training II' },
    { Designation: 'Nursing Attendants', Training: 'Nursing Attendant Training III' },
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
                '<label for="Document Requesting">Document Requesting:</label>'+
                '<select class="select-box" required name="certDesignation[]" class="certDesignation" id="certDesignation'+i+'">'+
                '<option hidden selected>Document Requesting:</option>'+
                '<option value="Nurses">Training for Nurses</option>'+
                '<option value="Ward Clerks">Training for Ward Clerks</option>'+
                '<option value="Nursing Attendants">Training for Nursing Attendants</option>'+
                '<option value="Nurses">Certification for Nurses</option>'+
                '<option value="Ward Clerks">Certification for Ward Clerks</option>'+
                '<option value="Nursing Attendants">Certification for Nursing Attendants</option>'+
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