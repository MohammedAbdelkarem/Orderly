<?php

namespace App\Constants;

final class ApiMessages
{
    const MSG_Created_SUCCESSFULLY                              = 'messages.CreatedSuccessfully';
    const MSG_UPDATED_SUCCESSFULLY                              = 'messages.UpdatedSuccessfully';
    const MSG_DELETED_SUCCESSFULLY                              = 'messages.DeletedSuccessfully';
    const MSG_CANCELLED_SUCCESSFULLY                            = 'messages.CancelledSuccessfully';
    const MSG_CORRECT_OTP                                       = 'messages.CorrectOtp';
    const MSG_FETCHED_SUCCESSFULLY                              = 'messages.DataSuccessfullyFetched';
    const MSG_ACTIVATE_RESOURCE_SUCCESSFULLY                    = 'messages.ActivateResourceSuccessfully';
    const MSG_STATUS_CHANGED_SUCCESSFULLY                       = 'messages.StatusChangedSeccussfully';
    const MSG_EMAIL_SENDED_SUCCESSFULLY                         = 'messages.EmailSendedSuccessfully';

    const MSG_ACTIVATE_RESOURCE_ACCOUNT_SUCCESSFULLY            = 'messages.ActivateResourceAccountSuccessfully';
    const MSG_DEACTIVATE_RESOURCE_SUCCESSFULLY                  = 'messages.DeActivateResourceSuccessfully';
    const MSG_NOT_ALLOWED                                       = 'messages.NotAllowed';
    const MSG_NOT_AUTHORIZED                                    = 'messages.NotAuthorized';
    const MSG_NOT_AUTHENTICATED                                 = 'messages.Unauthenticated';
    const MSG_NOT_FOUNDF                                        = 'messages.ResourceNotFoundF';
    const MSG_NOT_FOUND                                         = 'messages.ResourceNotFound';
    const MSG_NO_CONTENT                                        = 'messages.NoContent';
    const MSG_EMAIL_NOT_VERIFIED                                = 'messages.EmailNotVerified';
    const MSG_WRONG_PASSWORD                                    = 'messages.WrongPassword';
    const MSG_WRONG_OLD_PASSWORD                                = 'messages.WrongOldPassword';
    const MSG_SUCCESS                                           = 'messages.Success';
    const MSG_FAIL                                              = 'messages.Failed';
    const MSG_LOGIN_SUCCESSFULLY                                = 'messages.LoginSuccessfully';
    const MSG_LOGOUT_SUCCESSFULLY                               = 'messages.LoggoutSuccessfully';
    const MSG_SENDING_OTP_CODE                                  = "messages.SendingOTPVerificationCode";
    const MSG_INVALID_OTP_CODE                                  = 'messages.InvalidOTPCode';
    const MSG_UNACTIVE_ACCOUNT                                  = 'messages.UnactiveAccount';
    const MSG_INCOMPLETE_ACCOUNT                                = 'messages.InCompleteAccount';
    const MSG_INACTIVE_ACCOUNT                                  = 'messages.InActiveAccount';
    const MSG_INACTIVE_CUSTOMER_ACCOUNT                         = 'messages.InActiveCustomerAccount';
    const MSG_UNVERIFIED_CUSTOMER_OTP_CODE                      = 'messages.UnverifiedCustomerOTPCode';
    const MSG_FREEZED_ACCOUNT                                   = 'messages.FreezedAccount';
    const MSG_REFUSE_RESET_PASSWORD                             = 'messages.RefuseResetPassword';
    const MSG_RESET_PASSWORD_SUCCESSFULLY                       = 'messages.ResetPasswordSuccessfully';
    const MSG_EMAIL_ALREADY_TAKEN                               = 'messages.EmailAlreadyTaken';
    const MSG_METHOD_NOT_ALLOWED                                = 'messages.MethodNotAllowed';
    const MSG_URL_NOT_FOUND                                     = 'messages.URLNotFound';
    const MSG_LANGUAGE_NOT_SUPPORTED                            = 'messages.LanguageNotSupported';
    const MSG_User_Type_NOT_SUPPORTED                           = 'messages.LanguageNotSupported';
    const MSG_FIRST_HAPPINESS_MESSAGE                           = 'messages.FirstHappinessMessage';
    const MSG_SECOND_HAPPINESS_MESSAGE                          = 'messages.SecondHappinessMessage';
    const MSG_THIRD_HAPPINESS_MESSAGE                           = 'messages.ThirdHappinessMessage';
    const MSG_UNMATCHED_USER_TYPE                               = 'messages.UnmatchedUserType';
    const MSG_NOT_REGISTERED                                    = 'messages.NotRegistered';
    const MSG_OTP_CODE_SENDED_SUCCESSFULLY                      = 'messages.OTPSendedSuccessfully';
    const MSG_INVALID_RESET_PASSWORD_PROCESS                    = 'messages.InvalidResetPasswordProcess';
    const MSG_REFRESH_TOKEN                                     = 'messages.RefreshToken';
    const MSG_RESOURCE_APPROVED_SUCCESSFULLY                    = 'messages.ResourceApprovedSuccessfully';
    const MSG_RESOURCE_ACCEPTED_SUCCESSFULLY                    = 'messages.ResourceAcceptedSuccessfully';
    const MSG_RESOURCE_REJECTED_SUCCESSFULLY                    = 'messages.ResourceRejectedSuccessfully';
    const MSG_ALREADY_CAPTAIN_ACTIVE                            = 'messages.AlreadyCaptainActive';
    const MSG_VALID_OTP_CODE                                    = 'messages.InvalidOTPCode';
    const MSG_CAPTAIN_NOT_ATTENDANCE                            = 'messages.CaptainNotAttendance';
    const MSG_PENDING_OPERATION_ACCEPTANCE                      = 'messages.PendingOperationAcceptance';
    const MSG_FREEZED_SUCCESSFULLY                              = 'messages.FreezedSuccessfully';
    const MSG_UNFREEZED_ACCOUNT                                 = 'messages.unFreezedSuccessfully';
    const MSG_SET_VEHICLE_WORKED_SUCCESSFULLY                   = 'messages.SetVehicleWorked';
    const MSG_VEHICLE_HAS_ORDER                                 = 'messages.VehicleHasOrder';
    const MSG_NOT_PENDING_CAPTAIN_ATTENDANCE                    = 'messages.NotPendingCaptainAttendance';
    const MSG_SEND_RESOURCE_SUCCESSFULLY                        = 'messages.SendResourceSuccessfully';
    const MSG_SERVICE_UNAVAILABLE                               = 'messages.ServiceUnavailable';
    const MSG_NOTIFICATION_SERVICE_UNAVAILABLE                  = 'messages.NotificationServiceUnavailable';
    const MSG_GOOGLE_MAP_SERVICE_UNAVAILABLE                    = 'messages.GoogleMapServiceUnavailable';
    const MSG_NOT_ALLOWED_DELETE_CATEGORY                       = 'messages.NotAllowedDeleteCategory';
    const MSG_ADDED_TO_FAVORITE_SUCCESSFULLY                    = 'messages.AddedToFavoriteSuccessfully';
    const MSG_REMOVED_FROM_FAVORITE_SUCCESSFULLY                = 'messages.RemovedFromFavoriteSuccessfully';
    const MSG_FREEZE_CAPTAIN_NOT_ALLOWED                        = 'messages.FreezeCaptainNotAllowed';
    const MSG_DEACTIVATE_CAPTAIN_NOT_ALLOWED                    = 'messages.DeactivateCaptainNotAllowed';
    const MSG_CANCEL_ORDER_NOT_ALLOWED                          = 'messages.CancelOrderNotAllowed';

    const MSG_CAPTAIN_BALANCE_INSUFFICIENT_TO_ASSIGN_ORDER      = 'messages.CaptainBalanceInsufficientToAssignOrder';
    const MSG_ORDER_ASSIGNED_TO_CAPTAIN_SUCCESSFULLY            = 'messages.OrderAssignedToCaptainSuccessfully';
    const MSG_ORDER_NOT_ASSIGNED_TO_ONE_CAPTAIN                 = 'messages.OrderNotAssignedToOneCaptain';
    const MSG_ORDER_NOT_ASSIGNED_TO_ANY_CAPTAIN                 = 'messages.OrderNotAssignedToAnyCaptain';
    const MSG_ORDER_RECEIVING_TIME_EXPIRED                      = 'messages.OrderReceivingTimeExpired';
    const MSG_ORDER_ALREADY_BEING_DELIVERED                     = 'messages.OrderAlreadyBeingDelivered';
    const MSG_ORDER_CANCELLED                                   = 'messages.OrderCancelled';
    const MSG_CAPTAIN_WITHIN_RANGE_OF_RECEIVING_ORDER           = 'messages.CaptainWithinRangeOfReceivingOrder';
    const MSG_LOGOUT_CAPTAIN_NOT_ALLOWED_CAUSE_ONLINE           = 'messages.LogoutCaptainNotAllowedCauseOnline';
    const MSG_CHANGE_AVAILABILITY_STATUS_CAPTAIN_NOT_ALLOWED_CAUSE_HAS_ORDERS = 'messages.ChangeCaptainAvailabilityStatusNotAllowedCauseHasOrders';
    const MSG_NOT_ALLOWED_CHANGE_ORDERABLE_STATUS_TO_RECEIVED   = 'messages.NotAllowedChangeOrderableStatusToReceived';
    const MSG_INVALID_PLATFORM                                      = 'messages.InvalidPlatform';
    const MSG_NOT_ALLOWED_DELETE                                      = 'messages.NotAllowedDelete';
    const MSG_NOT_ALLOWED_UPDATE                                      = 'messages.NotAllowedUpdate';
}

