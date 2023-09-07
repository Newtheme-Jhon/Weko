<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v13/services/billing_setup_service.proto

namespace Google\Ads\GoogleAds\V13\Services;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A single operation on a billing setup, which describes the cancellation of an
 * existing billing setup.
 *
 * Generated from protobuf message <code>google.ads.googleads.v13.services.BillingSetupOperation</code>
 */
class BillingSetupOperation extends \Google\Protobuf\Internal\Message
{
    protected $operation;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Ads\GoogleAds\V13\Resources\BillingSetup $create
     *           Creates a billing setup. No resource name is expected for the new billing
     *           setup.
     *     @type string $remove
     *           Resource name of the billing setup to remove. A setup cannot be
     *           removed unless it is in a pending state or its scheduled start time is in
     *           the future. The resource name looks like
     *           `customers/{customer_id}/billingSetups/{billing_id}`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V13\Services\BillingSetupService::initOnce();
        parent::__construct($data);
    }

    /**
     * Creates a billing setup. No resource name is expected for the new billing
     * setup.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v13.resources.BillingSetup create = 2;</code>
     * @return \Google\Ads\GoogleAds\V13\Resources\BillingSetup|null
     */
    public function getCreate()
    {
        return $this->readOneof(2);
    }

    public function hasCreate()
    {
        return $this->hasOneof(2);
    }

    /**
     * Creates a billing setup. No resource name is expected for the new billing
     * setup.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v13.resources.BillingSetup create = 2;</code>
     * @param \Google\Ads\GoogleAds\V13\Resources\BillingSetup $var
     * @return $this
     */
    public function setCreate($var)
    {
        GPBUtil::checkMessage($var, \Google\Ads\GoogleAds\V13\Resources\BillingSetup::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Resource name of the billing setup to remove. A setup cannot be
     * removed unless it is in a pending state or its scheduled start time is in
     * the future. The resource name looks like
     * `customers/{customer_id}/billingSetups/{billing_id}`.
     *
     * Generated from protobuf field <code>string remove = 1 [(.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getRemove()
    {
        return $this->readOneof(1);
    }

    public function hasRemove()
    {
        return $this->hasOneof(1);
    }

    /**
     * Resource name of the billing setup to remove. A setup cannot be
     * removed unless it is in a pending state or its scheduled start time is in
     * the future. The resource name looks like
     * `customers/{customer_id}/billingSetups/{billing_id}`.
     *
     * Generated from protobuf field <code>string remove = 1 [(.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setRemove($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->whichOneof("operation");
    }

}

