<?php
/**
 * Soap Client using Microsoft's NTLM Authentication
 *
 * Copyright (c) 2008 Invest-In-France Agency http://www.invest-in-france.org
 *
 * Author : Thomas Rabaix
 *
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 * @link http://rabaix.net/en/articles/2008/03/13/using-soap-php-with-ntlm-authentication
 * @author Thomas Rabaix
 */

/**
 * Soap Client using Microsoft's NTLM Authentication
 *
 * @link http://rabaix.net/en/articles/2008/03/13/using-soap-php-with-ntlm-authentication
 * @author Thomas Rabaix
 * @author Michal Korzeniowski <mko_san@lafiel.net>
 * 
 */
class NTLMSoapClient extends SoapClient {
	/**
	 * Whether or not to validate ssl certificates
	 *
	 * @var boolean
	 */
	protected $validate = false;
	
	private static $classmap = array(
					    'SidAndAttributesType' => 'SidAndAttributesType',
					    'NonEmptyArrayOfGroupIdentifiersType' => 'NonEmptyArrayOfGroupIdentifiersType',
					    'NonEmptyArrayOfRestrictedGroupIdentifiersType' => 'NonEmptyArrayOfRestrictedGroupIdentifiersType',
					    'SerializedSecurityContextType' => 'SerializedSecurityContextType',
					    'ConnectingSIDType' => 'ConnectingSIDType',
					    'ExchangeImpersonationType' => 'ExchangeImpersonationType',
					    'ExchangeVersionType' => 'ExchangeVersionType',
					    'ProxySecurityContextType' => 'ProxySecurityContextType',
					    'ServerVersionInfo' => 'ServerVersionInfo',
					    'RequestServerVersion' => 'RequestServerVersion',
					    'NonEmptyStringType' => 'NonEmptyStringType',
					    'BaseEmailAddressType' => 'BaseEmailAddressType',
					    'MailboxTypeType' => 'MailboxTypeType',
					    'EmailAddressType' => 'EmailAddressType',
					    'SingleRecipientType' => 'SingleRecipientType',
					    'UnindexedFieldURIType' => 'UnindexedFieldURIType',
					    'DictionaryURIType' => 'DictionaryURIType',
					    'ExceptionPropertyURIType' => 'ExceptionPropertyURIType',
					    'GuidType' => 'GuidType',
					    'DistinguishedPropertySetType' => 'DistinguishedPropertySetType',
					    'MapiPropertyTypeType' => 'MapiPropertyTypeType',
					    'BasePathToElementType' => 'BasePathToElementType',
					    'PathToUnindexedFieldType' => 'PathToUnindexedFieldType',
					    'PathToIndexedFieldType' => 'PathToIndexedFieldType',
					    'PathToExceptionFieldType' => 'PathToExceptionFieldType',
					    'PropertyTagType' => 'PropertyTagType',
					    'anonymous' => 'anonymous',
					    'PathToExtendedFieldType' => 'PathToExtendedFieldType',
					    'NonEmptyArrayOfPathsToElementType' => 'NonEmptyArrayOfPathsToElementType',
					    'NonEmptyArrayOfPropertyValuesType' => 'NonEmptyArrayOfPropertyValuesType',
					    'ExtendedPropertyType' => 'ExtendedPropertyType',
					    'FolderQueryTraversalType' => 'FolderQueryTraversalType',
					    'SearchFolderTraversalType' => 'SearchFolderTraversalType',
					    'ItemQueryTraversalType' => 'ItemQueryTraversalType',
					    'DefaultShapeNamesType' => 'DefaultShapeNamesType',
					    'BodyTypeResponseType' => 'BodyTypeResponseType',
					    'FolderResponseShapeType' => 'FolderResponseShapeType',
					    'ItemResponseShapeType' => 'ItemResponseShapeType',
					    'AttachmentResponseShapeType' => 'AttachmentResponseShapeType',
					    'DisposalType' => 'DisposalType',
					    'ConflictResolutionType' => 'ConflictResolutionType',
					    'ResponseClassType' => 'ResponseClassType',
					    'ChangeDescriptionType' => 'ChangeDescriptionType',
					    'ItemChangeDescriptionType' => 'ItemChangeDescriptionType',
					    'FolderChangeDescriptionType' => 'FolderChangeDescriptionType',
					    'SetItemFieldType' => 'SetItemFieldType',
					    'SetFolderFieldType' => 'SetFolderFieldType',
					    'DeleteItemFieldType' => 'DeleteItemFieldType',
					    'DeleteFolderFieldType' => 'DeleteFolderFieldType',
					    'AppendToItemFieldType' => 'AppendToItemFieldType',
					    'AppendToFolderFieldType' => 'AppendToFolderFieldType',
					    'NonEmptyArrayOfItemChangeDescriptionsType' => 'NonEmptyArrayOfItemChangeDescriptionsType',
					    'NonEmptyArrayOfFolderChangeDescriptionsType' => 'NonEmptyArrayOfFolderChangeDescriptionsType',
					    'ItemChangeType' => 'ItemChangeType',
					    'NonEmptyArrayOfItemChangesType' => 'NonEmptyArrayOfItemChangesType',
					    'InternetHeaderType' => 'InternetHeaderType',
					    'NonEmptyArrayOfInternetHeadersType' => 'NonEmptyArrayOfInternetHeadersType',
					    'RequestAttachmentIdType' => 'RequestAttachmentIdType',
					    'AttachmentIdType' => 'AttachmentIdType',
					    'RootItemIdType' => 'RootItemIdType',
					    'NonEmptyArrayOfRequestAttachmentIdsType' => 'NonEmptyArrayOfRequestAttachmentIdsType',
					    'AttachmentType' => 'AttachmentType',
					    'ItemAttachmentType' => 'ItemAttachmentType',
					    'SyncFolderItemsCreateOrUpdateType' => 'SyncFolderItemsCreateOrUpdateType',
					    'FileAttachmentType' => 'FileAttachmentType',
					    'NonEmptyArrayOfAttachmentsType' => 'NonEmptyArrayOfAttachmentsType',
					    'SensitivityChoicesType' => 'SensitivityChoicesType',
					    'ImportanceChoicesType' => 'ImportanceChoicesType',
					    'BodyTypeType' => 'BodyTypeType',
					    'BodyType' => 'BodyType',
					    'BaseFolderIdType' => 'BaseFolderIdType',
					    'FolderClassType' => 'FolderClassType',
					    'DistinguishedFolderIdNameType' => 'DistinguishedFolderIdNameType',
					    'DistinguishedFolderIdType' => 'DistinguishedFolderIdType',
					    'FolderIdType' => 'FolderIdType',
					    'NonEmptyArrayOfBaseFolderIdsType' => 'NonEmptyArrayOfBaseFolderIdsType',
					    'TargetFolderIdType' => 'TargetFolderIdType',
					    'FindFolderParentType' => 'FindFolderParentType',
					    'BaseFolderType' => 'BaseFolderType',
					    'ManagedFolderInformationType' => 'ManagedFolderInformationType',
					    'FolderType' => 'FolderType',
					    'CalendarFolderType' => 'CalendarFolderType',
					    'ContactsFolderType' => 'ContactsFolderType',
					    'SearchFolderType' => 'SearchFolderType',
					    'TasksFolderType' => 'TasksFolderType',
					    'NonEmptyArrayOfFoldersType' => 'NonEmptyArrayOfFoldersType',
					    'BaseItemIdType' => 'BaseItemIdType',
					    'DerivedItemIdType' => 'DerivedItemIdType',
					    'ItemIdType' => 'ItemIdType',
					    'NonEmptyArrayOfBaseItemIdsType' => 'NonEmptyArrayOfBaseItemIdsType',
					    'ItemClassType' => 'ItemClassType',
					    'ResponseObjectCoreType' => 'ResponseObjectCoreType',
					    'ResponseObjectType' => 'ResponseObjectType',
					    'NonEmptyArrayOfResponseObjectsType' => 'NonEmptyArrayOfResponseObjectsType',
					    'FolderChangeType' => 'FolderChangeType',
					    'NonEmptyArrayOfFolderChangesType' => 'NonEmptyArrayOfFolderChangesType',
					    'WellKnownResponseObjectType' => 'WellKnownResponseObjectType',
					    'SmartResponseBaseType' => 'SmartResponseBaseType',
					    'SmartResponseType' => 'SmartResponseType',
					    'ReplyToItemType' => 'ReplyToItemType',
					    'ReplyAllToItemType' => 'ReplyAllToItemType',
					    'ForwardItemType' => 'ForwardItemType',
					    'CancelCalendarItemType' => 'CancelCalendarItemType',
					    'ReferenceItemResponseType' => 'ReferenceItemResponseType',
					    'SuppressReadReceiptType' => 'SuppressReadReceiptType',
					    'FindItemParentType' => 'FindItemParentType',
					    'ItemType' => 'ItemType',
					    'NonEmptyArrayOfAllItemsType' => 'NonEmptyArrayOfAllItemsType',
					    'AcceptItemType' => 'AcceptItemType',
					    'TentativelyAcceptItemType' => 'TentativelyAcceptItemType',
					    'DeclineItemType' => 'DeclineItemType',
					    'RemoveItemType' => 'RemoveItemType',
					    'PostReplyItemBaseType' => 'PostReplyItemBaseType',
					    'PostReplyItemType' => 'PostReplyItemType',
					    'MimeContentType' => 'MimeContentType',
					    'MessageDispositionType' => 'MessageDispositionType',
					    'CalendarItemCreateOrDeleteOperationType' => 'CalendarItemCreateOrDeleteOperationType',
					    'CalendarItemUpdateOperationType' => 'CalendarItemUpdateOperationType',
					    'AffectedTaskOccurrencesType' => 'AffectedTaskOccurrencesType',
					    'MessageType' => 'MessageType',
					    'TaskStatusType' => 'TaskStatusType',
					    'TaskDelegateStateType' => 'TaskDelegateStateType',
					    'TaskType' => 'TaskType',
					    'PostItemType' => 'PostItemType',
					    'BasePagingType' => 'BasePagingType',
					    'IndexBasePointType' => 'IndexBasePointType',
					    'IndexedPageViewType' => 'IndexedPageViewType',
					    'FractionalPageViewType' => 'FractionalPageViewType',
					    'CalendarViewType' => 'CalendarViewType',
					    'ContactsViewType' => 'ContactsViewType',
					    'ResolveNamesSearchScopeType' => 'ResolveNamesSearchScopeType',
					    'ResolutionType' => 'ResolutionType',
					    'MeetingRequestTypeType' => 'MeetingRequestTypeType',
					    'ReminderMinutesBeforeStartType' => 'ReminderMinutesBeforeStartType',
					    'anonymous' => 'anonymous',
					    'anonymous' => 'anonymous',
					    'LegacyFreeBusyType' => 'LegacyFreeBusyType',
					    'CalendarItemTypeType' => 'CalendarItemTypeType',
					    'ResponseTypeType' => 'ResponseTypeType',
					    'AttendeeType' => 'AttendeeType',
					    'NonEmptyArrayOfAttendeesType' => 'NonEmptyArrayOfAttendeesType',
					    'OccurrenceItemIdType' => 'OccurrenceItemIdType',
					    'RecurringMasterItemIdType' => 'RecurringMasterItemIdType',
					    'DayOfWeekType' => 'DayOfWeekType',
					    'DaysOfWeekType' => 'DaysOfWeekType',
					    'DayOfWeekIndexType' => 'DayOfWeekIndexType',
					    'MonthNamesType' => 'MonthNamesType',
					    'RecurrencePatternBaseType' => 'RecurrencePatternBaseType',
					    'IntervalRecurrencePatternBaseType' => 'IntervalRecurrencePatternBaseType',
					    'RegeneratingPatternBaseType' => 'RegeneratingPatternBaseType',
					    'DailyRegeneratingPatternType' => 'DailyRegeneratingPatternType',
					    'WeeklyRegeneratingPatternType' => 'WeeklyRegeneratingPatternType',
					    'MonthlyRegeneratingPatternType' => 'MonthlyRegeneratingPatternType',
					    'YearlyRegeneratingPatternType' => 'YearlyRegeneratingPatternType',
					    'RelativeYearlyRecurrencePatternType' => 'RelativeYearlyRecurrencePatternType',
					    'AbsoluteYearlyRecurrencePatternType' => 'AbsoluteYearlyRecurrencePatternType',
					    'RelativeMonthlyRecurrencePatternType' => 'RelativeMonthlyRecurrencePatternType',
					    'AbsoluteMonthlyRecurrencePatternType' => 'AbsoluteMonthlyRecurrencePatternType',
					    'WeeklyRecurrencePatternType' => 'WeeklyRecurrencePatternType',
					    'DailyRecurrencePatternType' => 'DailyRecurrencePatternType',
					    'TimeChangeType' => 'TimeChangeType',
					    'TimeZoneType' => 'TimeZoneType',
					    'RecurrenceRangeBaseType' => 'RecurrenceRangeBaseType',
					    'NoEndRecurrenceRangeType' => 'NoEndRecurrenceRangeType',
					    'EndDateRecurrenceRangeType' => 'EndDateRecurrenceRangeType',
					    'NumberedRecurrenceRangeType' => 'NumberedRecurrenceRangeType',
					    'RecurrenceType' => 'RecurrenceType',
					    'TaskRecurrenceType' => 'TaskRecurrenceType',
					    'OccurrenceInfoType' => 'OccurrenceInfoType',
					    'NonEmptyArrayOfOccurrenceInfoType' => 'NonEmptyArrayOfOccurrenceInfoType',
					    'DeletedOccurrenceInfoType' => 'DeletedOccurrenceInfoType',
					    'NonEmptyArrayOfDeletedOccurrencesType' => 'NonEmptyArrayOfDeletedOccurrencesType',
					    'CalendarItemType' => 'CalendarItemType',
					    'MeetingMessageType' => 'MeetingMessageType',
					    'MeetingRequestMessageType' => 'MeetingRequestMessageType',
					    'MeetingResponseMessageType' => 'MeetingResponseMessageType',
					    'MeetingCancellationMessageType' => 'MeetingCancellationMessageType',
					    'ImAddressKeyType' => 'ImAddressKeyType',
					    'EmailAddressKeyType' => 'EmailAddressKeyType',
					    'PhoneNumberKeyType' => 'PhoneNumberKeyType',
					    'PhysicalAddressIndexType' => 'PhysicalAddressIndexType',
					    'PhysicalAddressKeyType' => 'PhysicalAddressKeyType',
					    'FileAsMappingType' => 'FileAsMappingType',
					    'ContactSourceType' => 'ContactSourceType',
					    'CompleteNameType' => 'CompleteNameType',
					    'ImAddressDictionaryEntryType' => 'ImAddressDictionaryEntryType',
					    'EmailAddressDictionaryEntryType' => 'EmailAddressDictionaryEntryType',
					    'PhoneNumberDictionaryEntryType' => 'PhoneNumberDictionaryEntryType',
					    'PhysicalAddressDictionaryEntryType' => 'PhysicalAddressDictionaryEntryType',
					    'ImAddressDictionaryType' => 'ImAddressDictionaryType',
					    'EmailAddressDictionaryType' => 'EmailAddressDictionaryType',
					    'PhoneNumberDictionaryType' => 'PhoneNumberDictionaryType',
					    'PhysicalAddressDictionaryType' => 'PhysicalAddressDictionaryType',
					    'ContactItemType' => 'ContactItemType',
					    'DistributionListType' => 'DistributionListType',
					    'SearchParametersType' => 'SearchParametersType',
					    'ConstantValueType' => 'ConstantValueType',
					    'SearchExpressionType' => 'SearchExpressionType',
					    'AggregateType' => 'AggregateType',
					    'AggregateOnType' => 'AggregateOnType',
					    'BaseGroupByType' => 'BaseGroupByType',
					    'GroupByType' => 'GroupByType',
					    'StandardGroupByType' => 'StandardGroupByType',
					    'DistinguishedGroupByType' => 'DistinguishedGroupByType',
					    'GroupedItemsType' => 'GroupedItemsType',
					    'ExistsType' => 'ExistsType',
					    'FieldURIOrConstantType' => 'FieldURIOrConstantType',
					    'TwoOperandExpressionType' => 'TwoOperandExpressionType',
					    'ExcludesAttributeType' => 'ExcludesAttributeType',
					    'ExcludesValueType' => 'ExcludesValueType',
					    'ExcludesType' => 'ExcludesType',
					    'IsEqualToType' => 'IsEqualToType',
					    'IsNotEqualToType' => 'IsNotEqualToType',
					    'IsGreaterThanType' => 'IsGreaterThanType',
					    'IsGreaterThanOrEqualToType' => 'IsGreaterThanOrEqualToType',
					    'IsLessThanType' => 'IsLessThanType',
					    'IsLessThanOrEqualToType' => 'IsLessThanOrEqualToType',
					    'ContainmentModeType' => 'ContainmentModeType',
					    'ContainmentComparisonType' => 'ContainmentComparisonType',
					    'ContainsExpressionType' => 'ContainsExpressionType',
					    'NotType' => 'NotType',
					    'MultipleOperandBooleanExpressionType' => 'MultipleOperandBooleanExpressionType',
					    'AndType' => 'AndType',
					    'OrType' => 'OrType',
					    'RestrictionType' => 'RestrictionType',
					    'SortDirectionType' => 'SortDirectionType',
					    'FieldOrderType' => 'FieldOrderType',
					    'NonEmptyArrayOfFieldOrdersType' => 'NonEmptyArrayOfFieldOrdersType',
					    'NonEmptyArrayOfFolderNamesType' => 'NonEmptyArrayOfFolderNamesType',
					    'WatermarkType' => 'WatermarkType',
					    'SubscriptionIdType' => 'SubscriptionIdType',
					    'BaseNotificationEventType' => 'BaseNotificationEventType',
					    'BaseObjectChangedEventType' => 'BaseObjectChangedEventType',
					    'ModifiedEventType' => 'ModifiedEventType',
					    'MovedCopiedEventType' => 'MovedCopiedEventType',
					    'NotificationType' => 'NotificationType',
					    'NotificationEventTypeType' => 'NotificationEventTypeType',
					    'NonEmptyArrayOfNotificationEventTypesType' => 'NonEmptyArrayOfNotificationEventTypesType',
					    'SubscriptionTimeoutType' => 'SubscriptionTimeoutType',
					    'SubscriptionStatusFrequencyType' => 'SubscriptionStatusFrequencyType',
					    'BaseSubscriptionRequestType' => 'BaseSubscriptionRequestType',
					    'PushSubscriptionRequestType' => 'PushSubscriptionRequestType',
					    'PullSubscriptionRequestType' => 'PullSubscriptionRequestType',
					    'SubscriptionStatusType' => 'SubscriptionStatusType',
					    'SyncFolderItemsDeleteType' => 'SyncFolderItemsDeleteType',
					    'SyncFolderItemsReadFlagType' => 'SyncFolderItemsReadFlagType',
					    'SyncFolderItemsChangesType' => 'SyncFolderItemsChangesType',
					    'SyncFolderHierarchyCreateOrUpdateType' => 'SyncFolderHierarchyCreateOrUpdateType',
					    'SyncFolderHierarchyDeleteType' => 'SyncFolderHierarchyDeleteType',
					    'SyncFolderHierarchyChangesType' => 'SyncFolderHierarchyChangesType',
					    'MaxSyncChangesReturnedType' => 'MaxSyncChangesReturnedType',
					    'AvailabilityProxyRequestType' => 'AvailabilityProxyRequestType',
					    'MeetingAttendeeType' => 'MeetingAttendeeType',
					    'CalendarEventDetails' => 'CalendarEventDetails',
					    'CalendarEvent' => 'CalendarEvent',
					    'Duration' => 'Duration',
					    'EmailAddress' => 'EmailAddress',
					    'FreeBusyViewType' => 'FreeBusyViewType',
					    'anonymous' => 'anonymous',
					    'FreeBusyViewOptionsType' => 'FreeBusyViewOptionsType',
					    'WorkingPeriod' => 'WorkingPeriod',
					    'SerializableTimeZoneTime' => 'SerializableTimeZoneTime',
					    'SerializableTimeZone' => 'SerializableTimeZone',
					    'WorkingHours' => 'WorkingHours',
					    'FreeBusyView' => 'FreeBusyView',
					    'MailboxData' => 'MailboxData',
					    'SuggestionQuality' => 'SuggestionQuality',
					    'SuggestionsViewOptionsType' => 'SuggestionsViewOptionsType',
					    'AttendeeConflictData' => 'AttendeeConflictData',
					    'UnknownAttendeeConflictData' => 'UnknownAttendeeConflictData',
					    'TooBigGroupAttendeeConflictData' => 'TooBigGroupAttendeeConflictData',
					    'IndividualAttendeeConflictData' => 'IndividualAttendeeConflictData',
					    'GroupAttendeeConflictData' => 'GroupAttendeeConflictData',
					    'Suggestion' => 'Suggestion',
					    'SuggestionDayResult' => 'SuggestionDayResult',
					    'OofState' => 'OofState',
					    'ExternalAudience' => 'ExternalAudience',
					    'ReplyBody' => 'ReplyBody',
					    'UserOofSettings' => 'UserOofSettings',
					    'Value' => 'Value',
					    'IdFormatType' => 'IdFormatType',
					    'AlternateIdBaseType' => 'AlternateIdBaseType',
					    'AlternateIdType' => 'AlternateIdType',
					    'AlternatePublicFolderIdType' => 'AlternatePublicFolderIdType',
					    'AlternatePublicFolderItemIdType' => 'AlternatePublicFolderItemIdType',
					    'NonEmptyArrayOfAlternateIdsType' => 'NonEmptyArrayOfAlternateIdsType',
					    'UserIdType' => 'UserIdType',
					    'DistinguishedUserType' => 'DistinguishedUserType',
					    'PermissionReadAccessType' => 'PermissionReadAccessType',
					    'CalendarPermissionReadAccessType' => 'CalendarPermissionReadAccessType',
					    'BasePermissionType' => 'BasePermissionType',
					    'PermissionType' => 'PermissionType',
					    'CalendarPermissionType' => 'CalendarPermissionType',
					    'PermissionActionType' => 'PermissionActionType',
					    'PermissionLevelType' => 'PermissionLevelType',
					    'CalendarPermissionLevelType' => 'CalendarPermissionLevelType',
					    'PermissionSetType' => 'PermissionSetType',
					    'CalendarPermissionSetType' => 'CalendarPermissionSetType',
					    'EffectiveRightsType' => 'EffectiveRightsType',
					    'DeliverMeetingRequestsType' => 'DeliverMeetingRequestsType',
					    'DelegateUserType' => 'DelegateUserType',
					    'DelegatePermissionsType' => 'DelegatePermissionsType',
					    'DelegateFolderPermissionLevelType' => 'DelegateFolderPermissionLevelType',
					    'ConflictResultsType' => 'ConflictResultsType',
					    'ResponseCodeType' => 'ResponseCodeType',
					    'ResponseMessageType' => 'ResponseMessageType',
					    'MessageXml' => 'MessageXml',
					    'BaseResponseMessageType' => 'BaseResponseMessageType',
					    'BaseRequestType' => 'BaseRequestType',
					    'GetFolderType' => 'GetFolderType',
					    'CreateFolderType' => 'CreateFolderType',
					    'FindFolderType' => 'FindFolderType',
					    'FolderInfoResponseMessageType' => 'FolderInfoResponseMessageType',
					    'FindFolderResponseMessageType' => 'FindFolderResponseMessageType',
					    'FindFolderResponseType' => 'FindFolderResponseType',
					    'DeleteFolderType' => 'DeleteFolderType',
					    'DeleteFolderResponseType' => 'DeleteFolderResponseType',
					    'BaseMoveCopyFolderType' => 'BaseMoveCopyFolderType',
					    'MoveFolderType' => 'MoveFolderType',
					    'CopyFolderType' => 'CopyFolderType',
					    'UpdateFolderType' => 'UpdateFolderType',
					    'CreateFolderResponseType' => 'CreateFolderResponseType',
					    'GetFolderResponseType' => 'GetFolderResponseType',
					    'UpdateFolderResponseType' => 'UpdateFolderResponseType',
					    'MoveFolderResponseType' => 'MoveFolderResponseType',
					    'CopyFolderResponseType' => 'CopyFolderResponseType',
					    'GetItemType' => 'GetItemType',
					    'CreateItemType' => 'CreateItemType',
					    'UpdateItemType' => 'UpdateItemType',
					    'ItemInfoResponseMessageType' => 'ItemInfoResponseMessageType',
					    'UpdateItemResponseMessageType' => 'UpdateItemResponseMessageType',
					    'DeleteItemType' => 'DeleteItemType',
					    'AttachmentInfoResponseMessageType' => 'AttachmentInfoResponseMessageType',
					    'DeleteAttachmentResponseMessageType' => 'DeleteAttachmentResponseMessageType',
					    'BaseMoveCopyItemType' => 'BaseMoveCopyItemType',
					    'MoveItemType' => 'MoveItemType',
					    'CopyItemType' => 'CopyItemType',
					    'SendItemType' => 'SendItemType',
					    'SendItemResponseType' => 'SendItemResponseType',
					    'FindItemType' => 'FindItemType',
					    'CreateAttachmentType' => 'CreateAttachmentType',
					    'CreateAttachmentResponseType' => 'CreateAttachmentResponseType',
					    'DeleteAttachmentType' => 'DeleteAttachmentType',
					    'DeleteAttachmentResponseType' => 'DeleteAttachmentResponseType',
					    'GetAttachmentType' => 'GetAttachmentType',
					    'GetAttachmentResponseType' => 'GetAttachmentResponseType',
					    'CreateItemResponseType' => 'CreateItemResponseType',
					    'UpdateItemResponseType' => 'UpdateItemResponseType',
					    'GetItemResponseType' => 'GetItemResponseType',
					    'MoveItemResponseType' => 'MoveItemResponseType',
					    'CopyItemResponseType' => 'CopyItemResponseType',
					    'DeleteItemResponseType' => 'DeleteItemResponseType',
					    'FindItemResponseMessageType' => 'FindItemResponseMessageType',
					    'FindItemResponseType' => 'FindItemResponseType',
					    'ResolveNamesType' => 'ResolveNamesType',
					    'ResolveNamesResponseMessageType' => 'ResolveNamesResponseMessageType',
					    'ResolveNamesResponseType' => 'ResolveNamesResponseType',
					    'ExpandDLType' => 'ExpandDLType',
					    'ExpandDLResponseMessageType' => 'ExpandDLResponseMessageType',
					    'ExpandDLResponseType' => 'ExpandDLResponseType',
					    'CreateManagedFolderRequestType' => 'CreateManagedFolderRequestType',
					    'CreateManagedFolderResponseType' => 'CreateManagedFolderResponseType',
					    'SubscribeType' => 'SubscribeType',
					    'SubscribeResponseMessageType' => 'SubscribeResponseMessageType',
					    'SubscribeResponseType' => 'SubscribeResponseType',
					    'UnsubscribeType' => 'UnsubscribeType',
					    'UnsubscribeResponseType' => 'UnsubscribeResponseType',
					    'GetEventsType' => 'GetEventsType',
					    'GetEventsResponseMessageType' => 'GetEventsResponseMessageType',
					    'GetEventsResponseType' => 'GetEventsResponseType',
					    'SendNotificationResponseMessageType' => 'SendNotificationResponseMessageType',
					    'SendNotificationResponseType' => 'SendNotificationResponseType',
					    'SendNotificationResultType' => 'SendNotificationResultType',
					    'SyncFolderHierarchyType' => 'SyncFolderHierarchyType',
					    'SyncFolderHierarchyResponseMessageType' => 'SyncFolderHierarchyResponseMessageType',
					    'SyncFolderHierarchyResponseType' => 'SyncFolderHierarchyResponseType',
					    'SyncFolderItemsType' => 'SyncFolderItemsType',
					    'SyncFolderItemsResponseMessageType' => 'SyncFolderItemsResponseMessageType',
					    'SyncFolderItemsResponseType' => 'SyncFolderItemsResponseType',
					    'GetUserAvailabilityRequestType' => 'GetUserAvailabilityRequestType',
					    'FreeBusyResponseType' => 'FreeBusyResponseType',
					    'SuggestionsResponseType' => 'SuggestionsResponseType',
					    'GetUserAvailabilityResponseType' => 'GetUserAvailabilityResponseType',
					    'GetUserOofSettingsRequest' => 'GetUserOofSettingsRequest',
					    'GetUserOofSettingsResponse' => 'GetUserOofSettingsResponse',
					    'SetUserOofSettingsRequest' => 'SetUserOofSettingsRequest',
					    'SetUserOofSettingsResponse' => 'SetUserOofSettingsResponse',
					    'ConvertIdType' => 'ConvertIdType',
					    'ConvertIdResponseType' => 'ConvertIdResponseType',
					    'ConvertIdResponseMessageType' => 'ConvertIdResponseMessageType',
					    'GetDelegateType' => 'GetDelegateType',
					    'GetDelegateResponseMessageType' => 'GetDelegateResponseMessageType',
					    'DelegateUserResponseMessageType' => 'DelegateUserResponseMessageType',
					    'AddDelegateType' => 'AddDelegateType',
					    'BaseDelegateResponseMessageType' => 'BaseDelegateResponseMessageType',
					    'BaseDelegateType' => 'BaseDelegateType',
					    'AddDelegateResponseMessageType' => 'AddDelegateResponseMessageType',
					    'RemoveDelegateType' => 'RemoveDelegateType',
					    'RemoveDelegateResponseMessageType' => 'RemoveDelegateResponseMessageType',
					    'UpdateDelegateType' => 'UpdateDelegateType',
					    'UpdateDelegateResponseMessageType' => 'UpdateDelegateResponseMessageType',
					   );	

	/**
	 * Performs a SOAP request
	 *
	 * @link http://php.net/manual/en/function.soap-soapclient-dorequest.php
	 *
	 * @param string $request the xml soap request
	 * @param string $location the url to request
	 * @param string $action the soap action.
	 * @param integer $version the soap version
	 * @param integer $one_way
	 * @return string the xml soap response.
	 */
	public function __doRequest($request, $location, $action, $version,
		$one_way = 0) {
		//for debugging: output generated XML preior to making the call
		//print_r($request); die();
		$headers = array(
			'Method: POST',
			'Connection: Keep-Alive',
			'User-Agent: PHP-SOAP-CURL',
			'Content-Type: text/xml; charset=utf-8',
			'SOAPAction: "'.$action.'"',
		); // end $headers
		$this->__last_request_headers = $headers;
		$ch = curl_init($location);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->validate);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->validate);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		if($this->curlAuthNtlm){
		    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        	}
		curl_setopt($ch, CURLOPT_USERPWD, $this->user.':'.$this->password);

		$response = curl_exec($ch);
		//print_r($response); die();
		return $response;
	} // end function __doRequest()

	/**
	 * Returns last SOAP request headers
	 *
	 * @link http://php.net/manual/en/function.soap-soapclient-getlastrequestheaders.php
	 *
	 * @return string the last soap request headers
	 */
	public function __getLastRequestHeaders() {
		return implode("n", $this->__last_request_headers)."n";
	} // end function __getLastRequestHeaders()

	/**
	 * Sets whether or not to validate ssl certificates
	 *
	 * @param boolean $validate
	 */
	public function validateCertificate($validate = true) {
		$this->validate = $validate;

		return true;
	} // end public function validateCertificate()
} // end class NTLMSoapClient
