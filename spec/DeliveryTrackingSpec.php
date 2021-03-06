<?php

namespace spec\CoSpirit\DeliveryTracking;

use CoSpirit\DeliveryTracking\DeliveryEvent;
use CoSpirit\DeliveryTracking\DeliveryServiceInterface;
use CoSpirit\DeliveryTracking\DeliveryStatus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeliveryTrackingSpec extends ObjectBehavior
{
    function let(
        DeliveryServiceInterface $deliveryService,
        DeliveryStatus $deliveryStatus,
        DeliveryEvent $deliveryEvent
    ) {
        $deliveryService->getDeliveryStatus('trackingNumber')
            ->willReturn($deliveryStatus);
        $deliveryService->getTrackingNumberByInternalReference('internalReference')
            ->willReturn('trackingNumber');
        $deliveryService->getLastEvent('trackingNumber')
            ->willReturn($deliveryEvent);

        $this->beConstructedWith($deliveryService);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CoSpirit\DeliveryTracking\DeliveryTracking');
    }

    function it_should_retrieve_a_delivery_status_from_a_tracking_number()
    {
        $this->getDeliveryStatus('trackingNumber')
            ->shouldBeAnInstanceOf('CoSpirit\DeliveryTracking\DeliveryStatus');
    }

    function it_should_retrieve_a_delivery_status_from_an_internal_reference()
    {
        $this->getDeliveryStatusByInternalReference('internalReference')
            ->shouldBeAnInstanceOf('CoSpirit\DeliveryTracking\DeliveryStatus');
    }

    function it_should_retrieve_the_last_delivery_event_from_a_tracking_number()
    {
        $this->getLastEvent('trackingNumber')
            ->shouldBeAnInstanceOf('CoSpirit\DeliveryTracking\DeliveryEvent');
    }

    function it_should_retrieve_a_tracking_number_from_an_internal_reference()
    {
        $this->getTrackingNumberByInternalReference('internalReference')
            ->shouldEqual('trackingNumber');
    }
}
