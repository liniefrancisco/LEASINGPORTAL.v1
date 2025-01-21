window.myApp.controller('adminpayment', function($scope, $http, $compile) {

	var loader = null;
    var pertenant = '';
    var perstore  = '';

	// $scope.getenants = function()
	// {
	// 	let store = $scope.store;
	// 	let type  = $scope.tenanttype;

	// 	$http({
    //         headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8' },
    //         method: 'POST',
    //         url: `${$base_url}admingettenant`,
    //         data: $.param({store: store, type : type})
    //     }).then(function successCallback(response) {

    //     	$scope.tenants = response.data;
    //     });
	// }

    $scope.getenants = function() {
        let store = $scope.store;
        let type  = $scope.tenanttype;
        console.log(store);
    
        // Build the URL with query parameters
        let url = `${$base_url}admingettenant?store=${store}&type=${type}`;
    
        $http({
            headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8' },
            method: 'GET',
            url: url, // No need to change this, it uses the base URL and parameters correctly
        }).then(function successCallback(response) {
            $scope.tenants = response.data;
            console.log($scope.tenants);
        });

    $scope.getpayment = function()
    {
        let tenantID = $scope.tenantID;
        $scope.paymentupload      = false;
        $scope.paymentuploadtable = false;
        
        $('#loading').show();

        $http({
            headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8' },
            method: 'POST',
            url: `${$base_url}getpayment`,
            data: $.param({tenantID : tenantID})
        }).then(function successCallback(response) 
        {
            $('#loading').hide();

            if(response.data.length > 0)
            {

                $scope.paymentupload      = true;
                $scope.paymentuploadtable = true;
                $scope.payment            = response.data;
                pertenant                 = true;

                 $(document).ready(function()
                {
                    $('#paymentuploadtable').DataTable({
                        "aoColumnDefs": 
                        [{ "bSortable": false, "aTargets": [0] }]
                    });
                });
            }
            else
            {
                Swal.fire({
                    title: `<i class='fas fa-info-circle fa-lg' style='color:#005ce6'></i>`,
                    html: `<strong>NO PAYMENT DATA FOUND</strong>`,
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                })

                $scope.paymentupload      = false;
                $scope.paymentuploadtable = false;
            }
        });
    }

    $scope.getpaymentperstore = function()
    {
        let tenanttype = $scope.tenanttype;
        let store      = $scope.store;
        let date1      = $("[name = 'datefrom']").val();
        let date2      = $("[name = 'dateto']").val();

        $scope.paymentupload      = false;
        $scope.paymentuploadtable = false;

        $('#loading').show();

        $http({
            headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8' },
            method: 'POST',
            url: `${$base_url}getpaymentperstore`,
            data: $.param({type : tenanttype, store: store, date1: date1, date2: date2})
        }).then(function successCallback(response) 
        {
            $('#loading').hide();

            if(response.data.length > 0)
            {
                $scope.paymentupload      = true;
                $scope.paymentuploadtable = true;
                $scope.payment            = response.data;
                perstore                  = true;

                $(document).ready(function()
                {
                    $('#paymentuploadtable').DataTable({
                        "aoColumnDefs": 
                        [{ "bSortable": false, "aTargets": [0] }]
                    });
                });
            }
            else
            {
                Swal.fire({
                    title: `<i class='fas fa-info-circle fa-lg' style='color:#005ce6'></i>`,
                    html: `<strong>NO PAYMENT DATA FOUND</strong>`,
                    allowOutsideClick: false,
                    confirmButtonText: 'OK'
                })

                $scope.paymentupload      = false;
                $scope.paymentuploadtable = false;
            }
        });
    }

    $scope.uploadall = function()
    {
        $('#headerCheck').click(function(e) {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        if($("[name = 'headerCheck']").is(":checked"))
        {
            $scope.uploadselect = false;
        } 
        else
        {
            $scope.uploadselect = true;
        }
    }

    $scope.viewpayment = function(data)
    {
        let filename = data.receipt_doc
        window.open('http://172.16.161.37/agc-pms/assets/pdf/' + filename);
    }

    $scope.uploadpayment = function(data)
    {
        let paymentID = data.id;

        $.ajax({
            type: 'POST',
            url: `${$base_url}uploadpaymentdata`,
            data: {paymentID : paymentID},
            beforeSend: function() 
            {
                 $('#loading').show();
            },
            success: function(response) {

             $('#loading').hide();

                if(response.info == 'success')
                {
                 Swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: response.message
                    }).then((result) => { 

<<<<<<< HEAD
                        if(pertenant == true)
                        {
                            $scope.paymentupload = false;
                            $scope.getpayment();
                        }   
                        else if(perstore == true) 
                        {
                            $scope.paymentupload = false;
                            $scope.getpaymentperstore();
                        }                   
=======
                        // if(pertenant == true)
                        // {
                        //     $scope.paymentupload = false;
                        //     $scope.getpayment();
                        // }   
                        // else if(perstore == true) 
                        // {
                        //     $scope.paymentupload = false;
                        //     $scope.getpaymentperstore();
                        // }                   
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                    });
                }
                else
                {
                 const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: response.info,
                        text: response.message
                    })
                }

            }
        });
    }

<<<<<<< HEAD
	$scope.uploadpaymentselected = function(e)
    {
=======
	$scope.uploadpaymentselected = function(e){
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
        e.preventDefault();

        let formdata = new FormData(e.target);

        $.ajax({
            type: 'POST',
<<<<<<< HEAD
            url: `${$base_url}uploadpaymentdatachecked`,
=======
            url: `${$base_url}uploadpaymentpertenant`,
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
            data: formdata,
            enctype: 'multipart/form-data',
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() 
            {
                 $('#loading').show();
            },
            success: function(response) {

             $('#loading').hide();

                if(response.info == 'success')
                {
                    Swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: response.message
                    }).then((result) => {
<<<<<<< HEAD
                        if(pertenant == true)
                        {
                            $scope.paymentupload = false;
                            $scope.getpayment();
                        }   
                        else if(perstore == true) 
                        {
                            $scope.paymentupload = false;
                            $scope.getpaymentperstore();
                        }              
=======
                        location.reload();             
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                    });
                }
                else
                {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: response.info,
                        text: response.message
                    })
                }

            }
        });
    }

<<<<<<< HEAD
}
});
=======
})
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
