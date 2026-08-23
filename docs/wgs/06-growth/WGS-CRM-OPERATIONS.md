# WGS CRM Operations

Google Sheets is the commercial source of truth. This repository documents the
workflow and must not duplicate live prospect records.

## Pipeline states

`New prospect → Researching → Ready for outreach → Contacted → Follow-up due → Replied → Interested → Proposal → Won / Lost`

Each record should have an owner, current state, next action, due date, source,
last meaningful contact, and notes supported by evidence. Proposal value and won
value must use the CRM's defined currency and rules.

## Growth Ops report

Report new prospects, outreach due, follow-ups due, replies, active opportunities,
proposal value, won work, lost work, and blockers. Include date range and data
freshness. Never infer missing CRM data or reconstruct totals from memory.

## Operating rules

- Update the existing row; do not create duplicates for the same opportunity.
- Record a state change only when its criterion is met.
- Preserve lost/suppressed history.
- Treat email addresses and personal notes as confidential business data.
- Keep credentials, API tokens, and exported CRM data out of Git.

## Incomplete

The connected Sheet, column schema, state-entry criteria, owners, reporting
cadence, follow-up intervals, and value definitions require Liana's decision.
