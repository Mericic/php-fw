<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Conferences;

class Conference
{
    private $id;
    private $details;
    private $location;
    private $date;
    private $timeSlot;
    private $maxAttendees;
    private $registrationRule;
    private $attendees;

    public static function submit(ConferenceDetails $details, Date $date, TimeSlot $timeSlot, Location $location,
        int $maxAttendees, RegistrationRule $registrationRule): self
    {
        return new self($details, $date, $timeSlot, $location, $maxAttendees, $registrationRule);
    }

    private function __construct(ConferenceDetails $details, Date $date, TimeSlot $timeSlot, Location $location,
        int $maxAttendees, RegistrationRule $registrationRule)
    {
        $this->id = uniqid();
        $this->details = $details;
        $this->location = $location;
        $this->date = $date;
        $this->timeSlot = $timeSlot;
        $this->maxAttendees = $maxAttendees;
        $this->registrationRule = $registrationRule;
        $this->attendees = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function register(Attendee $attendee): void
    {
        $this->ensureConferenceHasNotReachedMaxAttendees();
        $this->attendees[] = $attendee;
    }

    private function ensureConferenceHasNotReachedMaxAttendees(): void
    {
        if ($this->hasPlacesLeft()) {

            throw new MaxAttendeesReached($this->maxAttendees);
        }
    }

    public function getDetails(): ConferenceDetails
    {
        return $this->details;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getTimeSlot(): TimeSlot
    {
        return $this->timeSlot;
    }

    public function getMaxAttendees(): int
    {
        return $this->maxAttendees;
    }

    public function hasPlacesLeft(): bool
    {
        return ((1 + \count($this->attendees)) > $this->maxAttendees);
    }

    public function areExternalPeopleAllowed(): bool
    {
        return $this->registrationRule->areExternalPeopleAllowed();
    }

    public function getExternalPeopleEntrancePrice(): ?Price
    {
        return $this->registrationRule->getExternalPeopleEntrancePrice();
    }
}
