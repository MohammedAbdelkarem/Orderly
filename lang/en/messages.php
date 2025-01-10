<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // General msgs
    'CreatedSuccessfully'                 => ':resource created successfully.',
    'UpdatedSuccessfully'               => ':resource Data updated successfully.',
    'DataSuccessfullyFetched'           => ':resource Data fetched successfully.',
    'DeletedSuccessfully'               => ':resource Data deleted successfully.',
    'SendingOTPVerificationCode'        => 'A verification OTP code has been sent to your email address, ',
    'EmailSendedSuccessfully'           => 'A verification OTP code has been sent to your email, ',
                                           'please use this code to verify your account.',
    'StatusChangedSeccussfully'         => ':resource status changed successfully',
    'SuccessfullyResettingPassword'     =>  'The code is correct and you have successfully resetting your password.',
    'InvalidOTPCode'                    => 'OTP code is invalid',
    'QuantityNotAvailable'              => 'the required quantity is bigger than the available quantity',
    'OrderStatus'                       => 'can not update the order because it is not on pending anymore , you can update just the pending orders',
    'CorrectOtp'                        => 'OTP code is correct',
    'EmptyData'                         => ':resource Is Empty ',
    'UserIsAlreadyExist'                => ':resource already exists',
    'Success'                           => 'Success',
    'Failed'                            => 'Failed',
    'AddedToFavoriteSuccessfully'       => 'Added to favorite successfully',
    'RemovedFromFavoriteSuccessfully'   => 'Removed from favorite successfully',

    // General Errors
    'ResourceNotFoundF'         => ':resource Not Found',
    'ResourceNotFound'          => ':resource Not Found',
    'ResourceAlreadyExist'      => ':resource already exist for :objectTwo',
    'DeletingFailed'            => 'Deleting Failed',
    'NoPermission'              => 'You do not have permission',
    'RoleNotFound'              => 'Role not found',
    'MethodNotAllowed'          => 'The specified method for the request is invalid.',
    'URLNotFound'               => 'The specified URL cannot be found',
    'NoContent'                 => 'No content',
    'LanguageNotSupported'      => 'Language not supported.',
    'UserTypeNotSupported'      => 'User type not supported.',
    // Auth Controller msgs
    'PasswordChangedSuccessfully'       => 'Password changed successfully !',
    'UserSuccessfullyRegistered'        => 'User successfully registered',
    'LoginSuccessfully'                 => 'logged in successfully',
    'LoggoutSuccessfully'               => 'logged out successfully',
    'UnmatchedUserType'                 => 'Unmatched user type, enter barber or customer as user type in the header of request.',
    // ERRORS
    'NotAllowedDeleteCategory'          => 'Deleting the category is not allowed because there are subcategories related to it, please delete those subcategories if you want to delete the category at all.',
    'NotAllowedDelete'                  => 'not allowed to delete because it has related :resource',
    'NotAllowedUpdate'                  => 'not allowed to update because it has related :resource',
    // Auth Controller error msgs
    'WrongPassword'                     => 'Invalid password.',
    'Unauthenticated'                   => 'Unatuehenticated! you must login to the system first.',
    'EmailNotVerified'                  => 'Your email is not verified.',
    'UnactiveAccount'                   => 'Unauthorized!, Your account is Unactive, a verification OTP code has been sent to your email, '.
                                           'please use this code to verify your identity and activate your account.',


    'InActiveCustomerAccount'           => 'You have already deactivated your account so an account verification code has been sent as a text message Please confirm your identity with this code in case you want to reactivate the account.',
    'UnverifiedCustomerOTPCode'                 => 'The process of registering your account is not already complete as you have registered but have not confirmed your identity so a verification code will be sent by text message so please use this message to complete the account registration.',


    'IncompleteAccount'                  => 'Unauthorized!, Your account is Uncompleted, a verification OTP code has been sent to your email, '.
                                           'please use this code to verify your identity and complete your account registration information.',
    'RefuseResetPassword'               => 'Bad Request!, Customer does not specify forget password befor that.',
    'WrongOldPassword'               => 'the old password is wrong',
    'EmailAlreadyTaken'                 => 'Unauthorized!, The email address you entered is already taken and registered on the system.',

    'newPasswordError'                  => 'New Password cannot be same as your current password. Please choose a different password.',
    'Unauthorized'                      => 'Error in Credentials',
    'ErrorInUserNameOrPhoneNumber'      => 'Error in phone number or user name',
    'AlreadyHandled'                    => 'reserve request already handled',
    'RequestHasAlreadyBeenSent'         => 'Request has already been sent',
    'UserNameOrPhoneNumberAlreadyExist' => 'user name or phone number already exists',
    'AddedToFavoriteSuccessfully'       => 'Added to favorite successfully',
    'ResetPasswordSuccessfully'         => 'password resetted successfully',
    // flamingo
    'InvalidPlatform'                   => 'Invalid platform , should be: friend or flamingo',
];
