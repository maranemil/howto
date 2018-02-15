##############################################
#
# Print all related actions from WF SugarCRM
#
##############################################

SELECT
#w.id as WID,
w.name as W_Name,
w.base_module as W_BASEMOD,
w.type as W_TYPE,
w.record_type as W_RECTYPE,
w.status as W_STATUS,

was.action_type as WAS_TYPE,
#was.id as WAS_ID,

wa.field as WA_FIELD,
wa.value as WA_VAL,
#wa.parent_id as WA_PARENTID,
wa.set_type as WA_SETTYPE,
wa.adv_type as WA_ADVTYPE,

wts.field as WTS_FIELD,
wts.type as WTS_TYPE,
wts.frame_type as WTS_FRAME
#wts.eval as WTS_EVAL,
#wts.parent_id as WTS_PARENDID

FROM workflow as w
LEFT JOIN workflow_actionshells as was ON was.parent_id = w.id
LEFT JOIN workflow_actions as wa ON wa.parent_id = was.id
LEFT JOIN workflow_triggershells as wts ON wts.parent_id = w.id
WHERE w.base_module = 'Quotes'
AND w.type ='Normal' # Time | Normal
AND w.deleted = 0
#WHERE w.id = 'ea362f7e-dd8d-e354-3421-514030af7063'
LIMIT 0, 500