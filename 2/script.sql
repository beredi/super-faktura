SELECT *
FROM duplicates
WHERE value IN (
    SELECT value
    FROM duplicates
    GROUP BY value
    HAVING COUNT(*) > 1
);