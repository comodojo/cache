<?php namespace Comodojo\Cache\Drivers;

use \Comodojo\Foundation\Utils\UniqueId;
use \Exception;

/**
 * @package     Comodojo Cache
 * @author      Marco Giovinazzi <marco.giovinazzi@comodojo.org>
 * @license     MIT
 *
 * LICENSE:
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Apcu extends AbstractDriver {

    const DRIVER_NAME = "apcu";

    /**
     * {@inheritdoc}
     */
    public function __construct(array $configuration = []) {

        if ( extension_loaded('apcu') === false ) throw new Exception("ext-apcu not available");

        // In cli, apcu SHOULD NOT use the request time for cache retrieve/invalidation.
        // This is because in cli the request time is allways the same.
        if ( php_sapi_name() === 'cli' ) {
            ini_set('apc.use_request_time', 0);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function test() {

        return (bool) ini_get('apc.enabled');

    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $namespace) {

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) return null;

        $shadowName = "$scope-$key";

        $item = apcu_fetch($shadowName, $success);

        return $success === false ? null : $item;

    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $namespace, $value, $ttl = null) {

        if ( $ttl == null ) $ttl = 0;

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) $scope = $this->setNamespaceKey($namespace);

        if ( $scope === false ) return false;

        $shadowName = "$scope-$key";

        return apcu_store($shadowName, $value, $ttl);

    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, $namespace) {

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) return false;

        $shadowName = "$scope-$key";

        return apcu_delete($shadowName);

    }

    /**
     * {@inheritdoc}
     */
    public function clear($namespace = null) {

        if ( $namespace == null ) {

            return apcu_clear_cache();

        } else {

            $scope = $this->getNamespaceKey($namespace);

            if ( $scope === false ) return false;

            return apcu_delete($namespace);

        }

    }

    /**
     * {@inheritdoc}
     */
    public function getMultiple(array $keys, $namespace) {

        $keypad = array_combine($keys, array_fill(0, count($keys), null));

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) return $keypad;

        $keyscope = array_map(function($key) use($scope) {
            return "$scope-$key";
        }, $keys);

        $data = apcu_fetch($keyscope, $success);

        $return = [];

        foreach ( $data as $scoped_key => $value ) {
            $key = substr($scoped_key, strlen("$scope-"));
            $return[$key] = $value;
        }

        return array_replace($keypad, $return);

    }

    /**
     * {@inheritdoc}
     */
    public function setMultiple(array $key_values, $namespace, $ttl = null) {

        if ( $ttl == null ) $ttl = 0;

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) $scope = $this->setNamespaceKey($namespace);

        if ( $scope === false ) return false;

        $shadowNames = [];

        foreach ( $key_values as $key => $value ) {
            $shadowNames["$scope-$key"] = $value;
        }

        $data = apcu_store($shadowNames, null, $ttl);

        return empty($data) ? true : false;

    }

    /**
     * {@inheritdoc}
     */
    public function deleteMultiple(array $keys, $namespace) {

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) return false;

        $shadowNames = array_map(function($key) use($scope) {
            return "$scope-$key";
        }, $keys);

        $delete = apcu_delete($shadowNames);

        return empty($delete) ? true : false;

    }

    /**
     * {@inheritdoc}
     */
    public function has($key, $namespace) {

        $scope = $this->getNamespaceKey($namespace);

        if ( $scope === false ) return false;

        return apcu_exists("$scope-$key");

    }

    /**
     * {@inheritdoc}
     */
    public function stats() {

        return apcu_cache_info(true);

    }

    /**
     * Set namespace key
     *
     * @return  mixed
     */
    private function setNamespaceKey($namespace) {

        $uId = UniqueId::generate(64);

        return apcu_store($namespace, $uId, 0) === false ? false : $uId;

    }

    /**
     * Get namespace key
     *
     * @return  string
     */
    private function getNamespaceKey($namespace) {

        return apcu_fetch($namespace);

    }

}
