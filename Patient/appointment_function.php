<?php

function AddAppointment($appointID,$type,$schedule,$date,$fees,$clinicFees,$docid,$docName,$patientid,$patientName,$patientContact,$patientGender,$patientAge,$patientDOB,$symptoms)
{
    $_SESSION['Appointment']=array();

    $_SESSION['Appointment'][0]['AppointmentID']=$appointID;
    $_SESSION['Appointment'][0]['AppType']=$type;
    $_SESSION['Appointment'][0]['Schedule']=$schedule;
    $_SESSION['Appointment'][0]['AppDate']=$date;
    $_SESSION['Appointment'][0]['DocID']=$docid;
    $_SESSION['Appointment'][0]['DocName']=$docName;
    $_SESSION['Appointment'][0]['Fees']=$fees;
    $_SESSION['Appointment'][0]['ClinicFees']=$clinicFees;
    $_SESSION['Appointment'][0]['PatientID']=$patientid;
    $_SESSION['Appointment'][0]['PatientName']=$patientName;
    $_SESSION['Appointment'][0]['PatientContact']=$patientContact;
    $_SESSION['Appointment'][0]['PatientGender']=$patientGender;
    $_SESSION['Appointment'][0]['PatientAge']=$patientAge;
    $_SESSION['Appointment'][0]['PatientDOB']=$patientDOB;
    $_SESSION['Appointment'][0]['Symptoms']=$symptoms;


    echo "<script>window.location='appointment.php'</script>";
}


?>