<?php
function AddMedServiceAppointment($appointID,$appointType,$serviceID,$serviceName,$serviceCost,$serviceQuantity,$date,$patientid,$patientName,$patientContact)
{
    $_SESSION['ServiceAppointment'] =array();
    
    $_SESSION['ServiceAppointment'][0]['AppointmentID']=$appointID;
    $_SESSION['ServiceAppointment'][0]['AppointmentType']=$appointType;
    $_SESSION['ServiceAppointment'][0]['ServiceID']=$serviceID;
    $_SESSION['ServiceAppointment'][0]['ServiceName']=$serviceName;
    $_SESSION['ServiceAppointment'][0]['Cost']=$serviceCost;
    $_SESSION['ServiceAppointment'][0]['Quantity']=$serviceQuantity;
    $_SESSION['ServiceAppointment'][0]['Date']=$date;
    $_SESSION['ServiceAppointment'][0]['PatientID']=$patientid;
    $_SESSION['ServiceAppointment'][0]['PatientName']=$patientName;
    $_SESSION['ServiceAppointment'][0]['Contact']=$patientContact;
    

    echo "<script>window.location='serviceAppointment.php'</script>";
  
}
?>