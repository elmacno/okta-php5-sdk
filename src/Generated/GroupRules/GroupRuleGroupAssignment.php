<?php

/*******************************************************************************
 * Copyright 2017 Okta, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 ******************************************************************************/
namespace Okta\Generated\GroupRules;

class GroupRuleGroupAssignment extends \Okta\Resource\AbstractResource
{
    const GROUP_IDS = 'groupIds';
    /**
     * Get the groupIds.
     *
     * @return array
     */
    public function getGroupIds()
    {
        return $this->getProperty(self::GROUP_IDS);
    }
    /**
     * Set the groupIds.
     *
     * @param mixed $groupIds The value to set.
     * @return self
     */
    public function setGroupIds($groupIds)
    {
        $this->setProperty(self::GROUP_IDS, $groupIds);
        return $this;
    }
}