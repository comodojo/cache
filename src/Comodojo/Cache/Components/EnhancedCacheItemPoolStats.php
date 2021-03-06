<?php namespace Comodojo\Cache\Components;

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

class EnhancedCacheItemPoolStats {

    protected $id;

    protected $provider;

    protected $status;

    protected $objects = 0;

    protected $options = [];

    public function __construct($id, $provider, $status = 0, $objects = 0, array $options = []) {

        $this->id = $id;
        $this->provider = $provider;
        $this->status = $status;
        $this->objects = $objects;
        $this->options = $options;

    }

    public function getId() {

        return $this->id;

    }

    public function getProvider() {

        return $this->provider;

    }

    public function getState() {

        return $this->status;

    }

    public function getObjects() {

        return $this->objects;

    }

    public function getOptions() {

        return $this->options;

    }

}
