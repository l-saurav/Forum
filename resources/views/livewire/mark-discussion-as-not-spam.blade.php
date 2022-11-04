<x-modal-confirm
    event-to-open-modal="custom-show-mark-discussion-as-not-spam-modal"
    event-to-close-modal="discussionWasMarkedAsNotSpam"
    modal-title="Reset Spam Counter"
    modal-description="Are you sure you want to mark this discussion as not spam? This will reset the spam counter to 0"
    modal-confirm-button-text="Reset Spam Counter"
    wire-click="markAsNotSpam"
/>