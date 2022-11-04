<x-modal-confirm
    event-to-open-modal="custom-show-mark-discussion-as-spam-modal"
    event-to-close-modal="discussionWasMarkedAsSpam"
    modal-title="Mark Discussion as Spam"
    modal-description="Are you sure you want to mark this discussion as spam?"
    modal-confirm-button-text="Mark as Spam"
    wire-click="markAsSpam"
/>