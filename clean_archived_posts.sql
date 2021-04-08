/* clean_archived_blog creates a MySQL scheduled event that runs at midnight UTC+0 every day
removes all archived blogs that have been archived for over 30 days */
CREATE EVENT IF NOT EXISTS clean_archived_posts
	ON SCHEDULE
		EVERY 1 DAY
        STARTS (TIMESTAMP(CURRENT_DATE) + INTERVAL 1 DAY)
        ON COMPLETION PRESERVE
        COMMENT 'Clean up old (>30 days) archived posts each day'
	DO
		DELETE FROM dev.posts WHERE is_archived=1 AND TIMESTAMPDIFF(DAY, archived_date, CURRENT_TIMESTAMP) >30;

/* Make sure the event has been created */
SHOW EVENTS;