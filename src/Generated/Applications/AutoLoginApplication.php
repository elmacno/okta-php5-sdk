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
namespace Okta\Generated\Applications;

class AutoLoginApplication extends \Okta\Applications\Application
{
    const SETTINGS = 'settings';
    const CREDENTIALS = 'credentials';
    /**
     * Get the settings.
     *
     * @return \Okta\Applications\ApplicationSettings
     */
    public function getSettings(array $options = [])
    {
        return $this->getResourceProperty(self::SETTINGS, \Okta\Applications\AutoLoginApplicationSettings::class, $options);
    }
    /**
     * Set the settings.
     *
     * @param \Okta\Applications\ApplicationSettings $settings The AutoLoginApplicationSettings instance.
     * @return self
     */
    public function setSettings(\Okta\Applications\ApplicationSettings $settings)
    {
        $this->setResourceProperty(self::SETTINGS, $settings);
        return $this;
    }
    /**
     * Get the credentials.
     *
     * @return \Okta\Applications\ApplicationCredentials
     */
    public function getCredentials(array $options = [])
    {
        return $this->getResourceProperty(self::CREDENTIALS, \Okta\Applications\SchemeApplicationCredentials::class, $options);
    }
    /**
     * Set the credentials.
     *
     * @param \Okta\Applications\ApplicationCredentials $credentials The SchemeApplicationCredentials instance.
     * @return self
     */
    public function setCredentials(\Okta\Applications\ApplicationCredentials $credentials)
    {
        $this->setResourceProperty(self::CREDENTIALS, $credentials);
        return $this;
    }
}